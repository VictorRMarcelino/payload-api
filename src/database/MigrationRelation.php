<?php

namespace src\database;

/**
 * Migration Relation
 * @package    src
 * @subpackage database
 * @author     VictorRamos <httpsvictorramos@gmail.com>
 * @since      07/05/2025
 */
class MigrationRelation {
    
    /** @var string */
    private $column;
    /** @var string */
    private $model;
    /** @var integer */
    private $type;
    /** @var boolean */
    private $primaryKey;

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
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     * @param integer $type
     */ 
    public function setType($type){
        $this->type = $type;
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

    public function __construct($sColumn, $sModel, $iType) {
        $this->setColumn($sColumn);
        $this->setModel($sModel);
        $this->setType($iType);
    }
}