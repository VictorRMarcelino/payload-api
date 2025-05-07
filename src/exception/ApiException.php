<?php

set_exception_handler(function($oException) {
    http_response_code($oException->getCode());
    $aResponse = [];
    $aResponse['code'] = $oException->getCode();
    $aResponse['message'] = $oException->getMessage();
    echo json_encode($aResponse);
});