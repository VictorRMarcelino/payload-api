<?php

use src\routes\Router;

set_exception_handler(function($oException) {
    $aResponse = [];
    $aResponse['code'] = $oException->getCode();
    $aResponse['message'] = $oException->getMessage();
    Router::response($aResponse, $oException->getCode());
});