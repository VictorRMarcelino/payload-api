<?php

namespace src\migrations;

use database\Migration;

/**
 * Migration Client
 * @package    database
 * @author     VictorRamos <httpsvictorramos@gmail.com>
 * @since      14/05/2025
 */
class MigrationClient extends Migration{

    /** @inheritDoc */
    public function getTable() {
        return 'tbclient';
    }

    /** @inheritDoc */
    public function initRelations() {
        $this->addRelation('cliid', 'id')->primaryKey();
        $this->addRelation('clilimit', 'limit');
        $this->addRelation('clibalance', 'balance');
    }
}