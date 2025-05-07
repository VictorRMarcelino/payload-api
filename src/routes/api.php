<?php

namespace src\routes;

use src\routes\Router;
use src\routes\Request;
use src\controller\ControllerTransaction;

Router::get('clientes/extrato', function(){});

Router::post('clientes/transacoes', function(Request $oRequest){
            $oControllerTransaction = new ControllerTransaction();
            $oControllerTransaction->doTransaction($oRequest);
});