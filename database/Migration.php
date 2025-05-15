<?php

namespace database;

use src\model\Model;

/**
 * Migration
 * @package    database
 * @author     VictorRamos <httpsvictorramos@gmail.com>
 * @since      07/05/2025
 */
abstract class Migration {
    
    /** @var Model */
    private $Model;

    /** @var MigrationRelation[] */
    private $relations = [];
    private $original;

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

    /**
     * Return all the relations of the migration
     */
    protected function getRelations() {
        return $this->relations;
    }

    /**
     * Get the value of original
     * @return Model
     */ 
    public function getOriginal(){
        return $this->original;
    }

    /**
     * Set the value of original
     * @param Model
     */ 
    public function setOriginal($original){
        $this->original = $original;
    }

    /** @inheritDoc */
    public function __construct() {
        $this->initRelations();
    }

    /**
     * Add a new relation
     * @return MigrationRelation
     */
    public function addRelation($sColumn, $sModel) {
        $oRelation = new MigrationRelation($sColumn, $sModel);
        $this->relations[] = $oRelation;
        return $oRelation;
    }

    /**
     * Return all register with specific conditions
     * @param array $aConditions
     * @return array
     */
    public function where(array $aConditions) {
        $sSql = $this->getSqlSelectAll($aConditions);
        return $this->getAllFromSql($sSql);
    }

    /**
     * Return all registers from a SQL
     * @param string $sSql
     * @return array
     */
    public function getAllFromSql($sSql) {
        $oCnx = Connection::getInstance();
        $oPdoStatment = $oCnx->getConnection()->query($sSql);
        $aReturn = [];

        $aRes = $oPdoStatment->fetchAll(\PDO::FETCH_ASSOC);

        if (is_array($aRes)) {
            foreach ($aRes as $aFetch) {
                $oModel = null;
                $this->loadModel($oModel, $aFetch);
                $aReturn[] = $oModel;
            }
        }

        return $aReturn;
    }

    /**
     * Return the first register of a query
     * @param string $sSql
     * @return array|false
     */
    public function getFirstFromSql($sSql) {
        $aRes = $this->getAllFromSql($sSql);
        
        if (is_array($aRes) && sizeof($aRes) > 0 ){
            return $aRes[0];
        }

        return false;
    }

    /** Load the model */
    public function loadModel(&$oModel = false, $aFetch = false) {
        if (!$oModel) {
            $oModel = $this->getModel();
        }

        if (!$aFetch) {
            $sSql = $this->getSqlSelectAll();
            $aFetch = $this->getFirstFromSql($sSql);
        }

        if (is_array($aFetch)) {
            foreach ($aFetch as $sColumn => $xValue) {
                $sSetMethod = 'set' . ucfirst($sColumn);
                $oModel->$sSetMethod($xValue);
            }
        }
    }

    /**
     * Return the SQL do searh for all the columns
     * @return string
     */
    private function getSqlSelectAll($aConditions = []) {
        $sSql = 'SELECT ';
        $sColumns = '';
        $aRelations = $this->getRelations();
        $sConditions = '';

        foreach ($aRelations as $oRelation) {
            if ($sColumns != '') {
                $sColumns .= ', ';
            }

            $sColumns .= $oRelation->getColumn() . ' as "' . $oRelation->getModel() . '"';

            if ($oRelation->getPrimaryKey()) {
                if ($sConditions != '') {
                    $sConditions .= ' AND ';
                }

                $sMethodGet = 'get' . ucfirst($oRelation->getModel());
                $xValue = $this->getModel()->$sMethodGet();
                $sConditions .= $oRelation->getColumn() . ' = ' . $xValue;
            }
        }

        if (sizeof($aConditions) > 0) {
            $sConditions = '';

            foreach ($aConditions as $sColumn => $xValue) {
                if ($sConditions != '') {
                    $sConditions .= ' AND ';
                }

                $sConditions .= $sColumn . ' = ' . $xValue;
            }
        }

        $sSql .= $sColumns . ' FROM ' . $this->getTable() . ' WHERE ' . $sConditions . ';';
        return $sSql;
    }

    /**
     * Insert a new register with the model data
     * @return boolean
     */
    public function insert() {
        $oCnx = Connection::getInstance();
        $sSql = $this->getSqlInsert();
        $oCnx->getConnection()->exec($sSql);
        return true;
    }

    /**
     * Return the SQL to insert a new register
     * @return string
     */
    private function getSqlInsert() {
        $sSql = 'INSERT INTO ' . $this->getTable() . ' (';
        $aRelations = $this->getRelations();
        $sColumns = '';
        $sValues = '';

        foreach ($aRelations as $oRelation) {
            if ($oRelation->getAutoincrement()) {
                continue;
            }
            
            if ($sColumns != '') {
                $sColumns .= ', ';
            }

            if ($sValues != '') {
                $sValues .= ', ';
            }

            $sColumns .= $oRelation->getColumn();
            $sMethodGet = 'get' . ucfirst($oRelation->getModel());
            $xValue = $this->getModel()->$sMethodGet();

            if (!is_integer($xValue)) {
                $xValue = "'$xValue'";   
            }

            $sValues .= $xValue;
        }

        $sSql .= $sColumns . ') VALUES (' . $sValues . ');';

        return $sSql;
    }

    /**
     * Update a register with the model data
     * @return boolean
     */
    public function update() {
        $oCnx = Connection::getInstance();
        $sSql = $this->getSqlUpdate();
        $oCnx->getConnection()->exec($sSql);
        return true;
    }

    /**
     * Return the SQL to insert a new register
     * @return string
     */
    private function getSqlUpdate() {
        $sSql = 'UPDATE ' . $this->getTable() . ' SET ';
        $aRelations = $this->getRelations();
        $sValues = '';
        $sConditions = '';

        foreach ($aRelations as $oRelation) {
            $sMethodGet = 'get' . ucfirst($oRelation->getModel());
            $xValue = $this->getModel()->$sMethodGet();

            if (!is_integer($xValue)) {
                $xValue = "'$xValue'";   
            }

            if ($oRelation->getPrimaryKey()) {
                if ($sConditions != '') {
                    $sConditions .= ', ';
                }

                $sConditions = $oRelation->getColumn() . ' = ' . $xValue;
            } else {
                if ($this->getOriginal()->$sMethodGet() == $xValue) {
                    continue;
                }

                if ($sValues != '') {
                    $sValues .= ' AND ';
                }

                $sValues = $oRelation->getColumn() . ' = ' . $xValue;
            }
        }

        $sSql .= $sValues . ' WHERE ' . $sConditions . ';';

        return $sSql;
    }

    /** 
     * Init the relations of the migration
     */
    abstract protected function initRelations();
    
    /**
     * Return the name of the table
     * @return string
     */
    abstract protected function getTable();
}