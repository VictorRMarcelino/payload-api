<?php

use routes\Router;

require_once 'vendor/autoload.php';
require_once 'src/exception/ApiException.php';

Router::getInstance()->doRequest();