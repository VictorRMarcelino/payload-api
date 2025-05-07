<?php

namespace src\routes;

use Exception;

/**
 * Request
 * @package routes
 * @author  VictorRamos <httpsvictorramos.gmail.com>
 * @since   27/04/2025
 */
class Request {

    private $method;
    private $url;
    private $parameters;

    /**
     * Get the value of method
     * @return string
     */ 
    public function getMethod(){
        return $this->method;
    }

    /**
     * Set the value of method
     * @param string $method
     */ 
    private function setMethod($method){
        $this->method = $method;
    }

    /**
     * Set the value of uri
     * @param string $url
     */ 
    private function setUrl($url){
        $this->url = $url;
    }

    /**
     * Return the URL of the request
     * @return string
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * Get the value of parameters
     * @param string $sParameter
     * @param boolean $bThrowException
     */ 
    public function getParameter($sParameter = false, $bThrowException = true){
        if ($sParameter){
            if (!isset($this->parameters[$sParameter])){
                throw new Exception("O parâmetro $sParameter não existe na requisição");
            }

            return $this->parameters[$sParameter];
        }

        return $this->parameters;
    }

    /**
     * Set the value of parameters
     * @param array $parameters
     */ 
    private function setParameters($parameters){
        $this->parameters = $parameters;
    }

    public function __construct() {
        $this->setMethod($_SERVER['REQUEST_METHOD']);
        $this->setUrl($this->loadUrl());
        $this->loadParameters();
    }

    /**
     * Extract the ID of the user from the URL
     * @return string
     */
    private function loadUrl() {
        $aUrl = explode('/', $_SERVER['REQUEST_URI']);
        $sUrl = $aUrl[1] . '/' . $aUrl[3];
        return $sUrl;
    }

    /**
     * Load the parameters send from the request
     * @return void
     */
    private function loadParameters() {
        $aBodyRequest = json_decode(file_get_contents('php://input'), true);
        $aUrl = explode('/', $_SERVER['REQUEST_URI']);

        if (!isset($aUrl[2]) || !is_numeric($aUrl[2])) {
            throw new Exception('O ID do cliente é inválido ou não foi recebido!', 400);
        }

        $aIdClient = ["idClient" => $aUrl[2]];
        $this->setParameters(array_merge($aIdClient, $aBodyRequest, $_GET));
    }
}