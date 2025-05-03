<?php

namespace src\model;

/**
 * Model Client Transaction
 * @package    src
 * @subpackage model
 * @author     VictorRamos <httpsvictorramos@gmail.com>
 * @since      30/04/2025
 */
class ModelClientTransaction extends Model{
    
    /**
     * @var ModelClient
     */
    private $Client;

    private $value;
    private $type;
    private $description;

    /**
     * Get the value of Client
     * @return ModelClient
     */ 
    public function getClient(){
        if (!isset($this->Client)){
            $this->Client = new ModelClient();
        }

        return $this->Client;
    }

    /**
     * Set the value of Client
     *
     * @param ModelClient $Client
     */ 
    public function setClient(ModelClient $Client){
        $this->Client = $Client;
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
}