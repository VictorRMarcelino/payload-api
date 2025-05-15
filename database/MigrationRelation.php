<?php

namespace database;

/**
 * Migration Relation
 * @package    database
 * @author     VictorRamos <httpsvictorramos@gmail.com>
 * @since      07/05/2025
 */
class MigrationRelation {
    
    /** @var string */
    private $column;
    /** @var string */
    private $model;
    /** @var boolean */
    private $primaryKey;
    /** @var boolean */
    private $autoincrement;

    /**
     * Get the value of column
     */ 
    public function getColumn(){
        return $this->column;
    }

    /**
     * Set the value of column
     * @param string
     */ 
    public function setColumn($column){
        $this->column = $column;
    }

    /**
     * Get the value of model
     * @return string
     */ 
    public function getModel(){
        return $this->model;
    }

    /**
     * Set the value of model
     * @param string
     */ 
    public function setModel($model){
        $this->model = $model;
    }

    /**
     * Get the value of primaryKey
     * @return boolean
     */ 
    public function getPrimaryKey(){
        return $this->primaryKey;
    }

    /**
     * Set the value of primaryKey
     * @param boolean $primaryKey
     */ 
    public function setPrimaryKey($primaryKey){
        $this->primaryKey = $primaryKey;
    }

    /**
     * Get the value of autoincrement
     * @return boolean
     */ 
    public function getAutoincrement(){
        return $this->autoincrement;
    }

    /**
     * Set the value of autoincrement
     * @param boolean $autoincrement
     */ 
    public function setAutoincrement($autoincrement){
        $this->autoincrement = $autoincrement;
    }

    public function __construct($sColumn, $sModel) {
        $this->setColumn($sColumn);
        $this->setModel($sModel);
    }

    /**
     * Define the relation as a primary key
     * @return MigrationRelation
     */
    public function primaryKey() {
        $this->setPrimaryKey(true);
        return $this;
    }

    /**
     * Define the relation as autoincrement
     * @return MigrationRelation
     */
    public function increment() {
        $this->setAutoincrement(true);
        return $this;
    }
}