<?php

namespace src\controller;

use src\model\ModelClient;
use src\model\ModelTransaction;
use src\routes\Request;
use src\routes\Router;

/**
 * Controller Extract
 * @package    src
 * @subpackage controller
 * @author     VictorRamos <httpsvictorramos@gmail.com>
 * @since      30/04/2025
 */
class ControllerExtract {

    /**
     * Return the extract of a client
     * @param \src\routes\Request $oRequest
     */
    public function getExtract(Request $oRequest) {
        $iIdClient = $oRequest->getParameter('idClient');
        $oClient = new ModelClient($iIdClient);
        $aExtract = ['saldo' => ['total' => $oClient->getBalance(), 'data_extrato' => date('d-m-Y h:i:s'), 'limite' => $oClient->getLimit(), 'ultimas_transacoes' => []]];
        $oTransacation = new ModelTransaction();
        $aTransactions = $oTransacation->where(['cliid' => $oClient->getId()]);

        foreach ($aTransactions as $oModelTransaction) {
            $aTransactionData = [];
            $aTransactionData['valor'] = $oModelTransaction->getValue();
            $aTransactionData['tipo'] = $oModelTransaction->getType();
            $aTransactionData['descricao'] = $oModelTransaction->getDescription();
            $aTransactionData['realizada_em'] = $oModelTransaction->getTimestamp();
            $aExtract['ultimas_transacoes'][] = $aTransactionData;
        }

        Router::getInstance()->response($aExtract);
    }
}