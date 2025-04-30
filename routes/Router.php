<?php

namespace routes;

/**
 * Router
 * @package routes
 * @author  VictorRamos <httpsvictorramos@gmail.com>
 * @since   27/04/2025
 */
class Router {

    protected $routes = [
        "get" => [
            "/clientes/extrato"    => ""
        ],
        "post"=> [
            "/clientes/transacoes" => ""
        ],
    ];
    
    /**
     * Return a static instance of Router
     * @return Router
     */
    public static function getInstance() {
        static $instance = null;

        if (!isset($instance)) {
            $instance = new Router();
        }

        return $instance;
    }

    /**
     * Process a request
     * @return void
     */
    public function doRequest() {
        $sMethodRequest = Request::getInstance()->getMethod();
        $sUrl           = Request::getInstance()->getUrl();

        if (isset($this->routes[$sMethodRequest][$sUrl])) {}
    }
}