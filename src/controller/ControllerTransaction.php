<?php

namespace src\controller;

use database\Connection;
use Exception;
use src\enum\EnumTransaction;
use src\model\ModelTransaction;
use src\routes\Request;
use src\model\ModelClient;
use src\routes\Router;

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
        Connection::getInstance()->begin();
        $iIdClient = $oRequest->getParameter('idClient');
        $oClient = new ModelClient($iIdClient);
        $this->insertTransaction($oRequest, $oClient);
        Connection::getInstance()->commit();
        Router::response(['message' => 'Transação realizada com sucesso!']);
    }

    /**
     * Load the informations about the transaction
     * @param Request $oRequest
     * @param ModelClient $oModelClient
     * @return \src\model\ModelTransaction
     */
    protected function insertTransaction(Request $oRequest, ModelClient $oModelClient) {
        $iValue = $oRequest->getParameter('valor');
        $sType = $oRequest->getParameter('tipo');
        $sDescription = $oRequest->getParameter('descricao');

        $this->validateValue($iValue);
        $this->validateType($sType);
        $this->validateDescription($sDescription);

        $oTransaction = new ModelTransaction;
        $oTransaction->setValue($iValue);
        $oTransaction->setType($sType);
        $oTransaction->setDescription($sDescription);
        $oTransaction->setTimestamp(date('d-m-Y h:i:s'));
        $oTransaction->setIdclient($oModelClient->getId());

        $this->validateBalanceDebitTransaction($oTransaction, $oModelClient);

        return $oTransaction->insert();
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
        if (!in_array($sType, [EnumTransaction::TYPE_DEBIT, EnumTransaction::TYPE_CREDIT])) {
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

    /**
     * Summary of validaLimit
     * @param ModelTransaction $oTransaction
     * @param ModelClient $oModelClient
     * @throws Exception
     */
    public function validateBalanceDebitTransaction(ModelTransaction $oTransaction, ModelClient $oModelClient) {
        if ($oTransaction->getType() != EnumTransaction::TYPE_DEBIT) {
            return;
        }

        $iNewBalance = $oModelClient->getBalance() + $oTransaction->getValue();

        if ($iNewBalance > $oModelClient->getLimit()) {
            throw new Exception('Transação Negada! A transação irá ultrapassar o limite de R$' . $oModelClient->getLimit() . ' reais. (Saldo após a transação: ' . $iNewBalance . ')');
        }

        $oModelClient->setBalance($iNewBalance);
        $oModelClient->update();
    }
}