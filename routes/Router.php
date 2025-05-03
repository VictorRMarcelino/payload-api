<?php

namespace routes;

use Exception;
use src\controller\ControllerTransaction;

/**
 * Router
 * @package routes
 * @author  VictorRamos <httpsvictorramos@gmail.com>
 * @since   27/04/2025
 */
class Router {

    protected $routes = [];
    
    /**
     * Return a static instance of Router
     * @return Router
     */
    public static function getInstance() {
        static $instance = null;

        if (!isset($instance)) {
            $instance = new Router();
            $instance->addRoutes();
        }

        return $instance;
    }

    /**
     * Add a new GET route
     * @param string $route
     * @param mixed $fn
     */
    private function get($route, $fn) {
        $this->routes['get'][$route] = $fn;
    }

    /**
     * Add a new POST route
     * @param string $route
     * @param mixed $fn
     */
    private function post($route, $fn) {
        $this->routes['post'][$route] = $fn;
    }

    /**
     * Add the routes
     */
    private function addRoutes() {
        $this->get('clientes/extrato', function(){});

        $this->post('clientes/transacoes', function(Request $oRequest){
            $oControllerTransaction = new ControllerTransaction();
            $oControllerTransaction->doTransaction($oRequest);
        });
    }

    /**
     * Process a request
     * @return void
     */
    public function doRequest() {
        $oRequest = new Request();
        $sMethodRequest = strtolower($oRequest->getMethod());
        $sUrl = $oRequest->getUrl();

        if (!isset($this->routes[$sMethodRequest][$sUrl])) {
            throw new Exception("O endpoint informado não existe!", 404);
        }

        call_user_func_array($this->routes[$sMethodRequest][$sUrl], [$oRequest]);
    }
}