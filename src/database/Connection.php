<?php

namespace database;

use Exception;
use PDO;
use PDOException;

/**
 * Connection
 * @package    src
 * @subpackage database
 * @author     VictorRamos <httpsvictorramos@gmail.com>
 * @since      07/05/2025
 */
class Connection {

    /** @var PDO */
    private $connection;

    /**
     * Get the value of connection
     * @return PDO
     */ 
    public function getConnection(){
        return $this->connection;
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
}