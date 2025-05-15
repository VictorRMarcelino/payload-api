<?php

namespace src\model;

/**
 * Model Transaction
 * @package    src
 * @subpackage model
 * @author     VictorRamos <httpsvictorramos@gmail.com>
 * @since      30/04/2025
 */
class ModelTransaction extends Model{
    
    private $id;
    private $value;
    private $type;
    private $description;
    private $timestamp;
    private $idclient;

    /**
     * Get the value of id
     * @return int
     */ 
    public function getId(){
        return $this->id;
    }

    /**
     * Set the value of id
     * @param int
     */ 
    public function setId($id){
        $this->id = $id;
    }

    /**
     * Get the value of value
     * @return int
     */ 
    public function getValue(){
        return $this->value;
    }

    /**
     * Set the value of value
     * @param int $value
     */ 
    public function setValue($value){
        $this->value = $value;
    }

    /**
     * Get the value of type
     * @return string
     */ 
    public function getType(){
        return $this->type;
    }

    /**
     * Set the value of type
     * @param string $type
     */ 
    public function setType($type){
        $this->type = $type;
    }

    /**
     * Get the value of description
     * @return string
     */ 
    public function getDescription(){
        return $this->description;
    }

    /**
     * Set the value of description
     * @param string $description
     */ 
    public function setDescription($description){
        $this->description = $description;
    }

    /**
     * Get the value of idclient
     * @return integer
     */ 
    public function getIdclient(){
        return $this->idclient;
    }

    /**
     * Set the value of idclient
     * @param integer $idclient
     */ 
    public function setIdclient($idclient){
        $this->idclient = $idclient;
    }

    /**
     * Get the value of timestamp
     * @return string
     */ 
    public function getTimestamp(){
        return $this->timestamp;
    }

    /**
     * Set the value of timestamp
     * @param string
     */ 
    public function setTimestamp($timestamp){
        $this->timestamp = $timestamp;
    }
}