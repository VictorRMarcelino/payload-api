<?php

namespace src\controller;

use Exception;
use src\routes\Request;
use src\model\ModelClient;
use src\model\ModelClientTransaction;

/**
 * Controller Transaction
 * @package    src
 * @subpackage controller
 * @author     VictorRamos <httpsvictorramos@gmail.com>
 * @since      30/04/2025
 */
class ControllerTransaction {

    /**
     * Do the transaction
     * @param Request $oRequest
     */
    public function doTransaction(Request $oRequest) {
        $iIdClient = $oRequest->getParameter('idClient');
        $oClient = new ModelClient($iIdClient);
        $oTransaction = $this->loadTransactionData($oRequest, $oClient);
    }

    /**
     * Load the informations about the transaction
     * @param Request $oRequest
     * @param ModelClient $oModelClient
     * @return ModelClientTransaction
     */
    protected function loadTransactionData(Request $oRequest, ModelClient $oModelClient) {
        $iValue = $oRequest->getParameter('valor');
        $sType = $oRequest->getParameter('tipo');
        $sDescription = $oRequest->getParameter('descricao');

        $this->validateValue($iValue);
        $this->validateType($sType);
        $this->validateDescription($sDescription);

        $oTransaction = $oModelClient->newTransaction();
        $oTransaction->setValue($iValue);
        $oTransaction->setType($sType);
        $oTransaction->setDescription($sDescription);
        return $oTransaction;
    }

    /**
     * Validate the value of the transaction
     * @param integer $iValue
     * @return void
     */
    protected function validateValue($iValue) {
        if (!is_integer($iValue)) {
            throw new Exception('O valor da transação precisa ser um valor inteiro', 422);
        }
    }

    /**
     * Validate the type of the transaction
     * @param string $sType
     * @return void
     */
    protected function validateType($sType) {
        if ($sType !== 'c' && $sType !== 'd') {
            throw new Exception('O tipo da transação é inválida', 422);
        }
    }

    /**
     * Validate the description of the transaction
     * @param string $sType
     * @return void
     */
    protected function validateDescription($sDescription) {
        if (strlen($sDescription) > 10) {
            throw new Exception('A descrição da transação não pode conter mais do que 10 caracteres', 422);
        }
    }
}