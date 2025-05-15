<?php

namespace src\model;

use database\Migration;

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
            $sMigration = 'src\\migrations\Migration' . $sMigrationName;
            $this->Migration = new $sMigration();
            $this->Migration->setModel($this);
            $this->Migration->setOriginal(clone $this);
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

    public function __construct() {
        $this->getMigration();        
    }

    /**
     * Load an instance with the database data
     */
    public function load() {
        $this->getMigration()->loadModel();
    }

    /**
     * Insert the model in the database
     * @return boolean
     */
    public function insert() {
        return $this->getMigration()->insert();
    }
    
    /**
     * Update the model in the database
     * @return boolean
     */
    public function update() {
        return $this->getMigration()->update();
    }

    /**
     * Return all register with specific conditions
     * @param array $aConditions
     * @return array
     */
    public function where(array $aConditions) {
        return $this->getMigration()->where($aConditions);
    }
}