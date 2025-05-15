<?php

namespace src\routes;

use src\controller\ControllerExtract;
use src\routes\Router;
use src\routes\Request;
use src\controller\ControllerTransaction;

Router::get('clientes/extrato', function(Request $oRequest){
    $oControllerExtract = new ControllerExtract();
    $oControllerExtract->getExtract($oRequest);
});

Router::post('clientes/transacoes', function(Request $oRequest){
    $oControllerTransaction = new ControllerTransaction();
    $oControllerTransaction->doTransaction($oRequest);
});