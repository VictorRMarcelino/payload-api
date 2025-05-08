<?php

namespace src\database;

use database\Connection;
use src\model\Model;

/**
 * Migration
 * @package    src
 * @subpackage database
 * @author     VictorRamos <httpsvictorramos@gmail.com>
 * @since      07/05/2025
 */
abstract class Migration {
    
    /** @var Model */
    private $Model;

    /** @var MigrationRelation[] */
    private $relations = [];

    /**
     * Get the value of Model
     * @return Model
     */ 
    public function getModel(){
        return $this->Model;
    }

    /**
     * Set the value of Model
     * @param Model
     */ 
    public function setModel($Model){
        $this->Model = $Model;
    }

    /** @inheritDoc */
    public function __construct() {
        $this->addRelations();
    }

    abstract protected function addRelations();
    abstract protected function getTable();
}