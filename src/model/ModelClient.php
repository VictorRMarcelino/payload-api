<?php

namespace src\model;

/**
 * Model Client
 * @package    src
 * @subpackage model
 * @author     VictorRamos <httpsvictorramos@gmail.com>
 * @since      30/04/2025
 */
class ModelClient extends Model{
    private $id;
    private $limit;
    private $balance;
    private $transactions = [];

    /**
     * Get the value of id
     * @return int
     */ 
    public function getId(){
        return $this->id;
    }

    /**
     * Set the value of id
     * @param int $id
     */ 
    public function setId($id){
        $this->id = $id;
    }

    /**
     * Get the value of limit
     * @return int
     */ 
    public function getLimit(){
        return $this->limit;
    }

    /**
     * Set the value of limit
     * @param int $limit
     */ 
    public function setLimit($limit){
        $this->limit = $limit;
    }

    /**
     * Get the value of balance
     * @return int
     */ 
    public function getBalance(){
        return $this->balance;
    }

    /**
     * Set the value of balance
     * @param int $balance
     */ 
    public function setBalance($balance){
        $this->balance = $balance;
    }

    /**
     * Construct an instance of ModelClient
     * @param int $iId
     */
    public function __construct($iId = false) {
        if ($iId) {
            $this->setId($iId);
            $this->load();
        } 
    }

    /**
     * Add a new transaction
     * @return ModelClientTransaction
     */
    public function newTransaction() {
        $oTransaction = new ModelClientTransaction();
        $oTransaction->setClient($this);
        $this->transactions[] = $oTransaction;
        return $oTransaction;
    }
}