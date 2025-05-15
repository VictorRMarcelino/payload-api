<?php

namespace src\migrations;

use database\Migration;

/**
 * Migration Transaction
 * @package    src
 * @subpackage migration
 * @author     VictorRamos <httpsvictorramos@gmail.com>
 * @since      14/05/2025
 */
class MigrationTransaction extends Migration {

    /** @inheritDoc */
    public function getTable() {
        return 'tbtransaction';
    }

    /** @inheritDoc */
    public function initRelations() {
        $this->addRelation('traid', 'id')->primaryKey()->increment();
        $this->addRelation('travalue', 'value');
        $this->addRelation('tratype', 'type');
        $this->addRelation('tradescription', 'description');
        $this->addRelation('tratimestamp', 'timestamp');
        $this->addRelation('cliid', 'idclient');
    }
}