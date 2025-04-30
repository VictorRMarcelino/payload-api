<?php

namespace routes;

/**
 * Request
 * @package routes
 * @author  VictorRamos <httpsvictorramos.gmail.com>
 * @since   27/04/2025
 */
class Request {

    private $method;
    private $url;
    private $idClient;

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
     * Get the value of idClient
     * @return int
     */ 
    public function getIdClient(){
        return $this->idClient;
    }

    /**
     * Set the value of idClient
     * @param int
     */ 
    public function setIdClient($idClient){
        $this->idClient = $idClient;
    }

    public function __construct() {
        $this->setMethod($_SERVER['REQUEST_METHOD']);
        list($sUrl, $iIdClient) = $this->extractIdUserUrl();
        $this->setUrl($sUrl);
        $this->setIdClient($iIdClient);
    }

    /**
     * Return a static instance of Request
     * @return Request
     */
    public static function getInstance() {
        static $instance;

        if (!isset($instance)) {
            $instance = new Request();
        }

        return $instance;
    }

    /**
     * Extract the ID of the user from the URL
     * @return array
     */
    private function extractIdUserUrl() {
        $aUrl = explode('/', $_SERVER['REQUEST_URI']);
        $sUrl = $aUrl[1] . '/' . $aUrl[3];
        return [$sUrl, $aUrl[2]];
    }
}