<?php

namespace src\model;

use src\database\Migration;

/**
 * Model
 * @package    src
 * @subpackage model
 * @author     VictorRamos <httpsvictorramos@gmail.com>
 * @since      01/05/2025
 */
abstract class Model {

    /** @var Migration */
    private $Migration;

    /**
     * Get the value of Migration
     * @return Migration
     */ 
    public function getMigration(){
        if (!isset($this->Migration)) {
            $sClassName = get_class($this);
            $aClassName = explode('\\', $sClassName);
            $sMigrationName = preg_replace('/Model/', '', $aClassName[2]);
            $sMigration = '\src\database\Migration';
            $this->Migration = new $sMigration();
            $this->Migration->setModel($this);
        }

        return $this->Migration;
    }

    /**
     * Set the value of Migration
     * @param Migration
     */ 
    public function setMigration($Migration){
        $this->Migration = $Migration;
    }

    /**
     * Load an instance with the database data
     */
    public function load() {
        //@todo implements load model function
    }
}