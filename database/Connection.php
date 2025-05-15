<?php

namespace database;

use Exception;
use PDO;
use PDOException;

/**
 * Connection
 * @package    database
 * @author     VictorRamos <httpsvictorramos@gmail.com>
 * @since      07/05/2025
 */
class Connection {

    /** @var PDO */
    private $connection;
    private $inTransaction;

    /**
     * Get the value of connection
     * @return PDO
     */ 
    public function getConnection(){
        return $this->connection;
    }

    /**
     * Get the value of inTransaction
     * @return boolean
     */ 
    public function getInTransaction(){
        return $this->inTransaction;
    }

    /**
     * Set the value of inTransaction
     * @param boolean $inTransaction
     */ 
    public function setInTransaction($inTransaction){
        $this->inTransaction = $inTransaction;
    }

    /**
     * Return the static connection instance
     * @return Connection
     */
    public static function getInstance() {
        static $instance = null;

        if (!isset($instance)) {
            $instance = new Connection();
            $instance->connect();
        }

        return $instance;
    }

    /**
     * Connection with the sqlite database
     * @return void
     */
    private function connect() {
        try {
            $this->connection = new PDO('sqlite:database/payloadapi.db');
        } catch (PDOException $oException) {
            throw new Exception('Ocorreu um erro ao se conectar com o banco de dados! Erro: ' . $oException->getMessage(), 500);
        }
    }

    /**
     * Init a transaction
     */
    public function begin() {
        if ($this->inTransaction) {
            return;
        }

        $oConnection = $this->getConnection();
        $sSql = 'BEGIN TRANSACTION';
        $oConnection->exec($sSql);
        $this->setInTransaction(true);
    }

    /**
     * Commit a transaction
     */
    public function commit() {
        if (!$this->inTransaction) {
            return;
        }

        $oConnection = $this->getConnection();
        $sSql = 'COMMIT';
        $oConnection->exec($sSql);
        $this->setInTransaction(false);
    }

    /**
     * Rollback a transaction
     */
    public function rollback() {
        if (!$this->inTransaction) {
            return;
        }

        $oConnection = $this->getConnection();
        $sSql = 'ROLLBACK';
        $oConnection->exec($sSql);
        $this->setInTransaction(false);
    }
}