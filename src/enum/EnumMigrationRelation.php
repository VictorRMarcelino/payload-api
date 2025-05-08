<?php

namespace src\enum;

/**
 * eNUM Migration Relation
 * @package    src
 * @subpackage enum
 * @author     VictorRamos <httpsvictorramos@gmail.com>
 * @since      07/05/2025
 */
abstract class EnumMigrationRelation {

    const TYPE_BIGINT = 1,
          TYPE_VARCHAR = 2,
          TYPE_SMALLINT = 3;
}
