<?php

namespace src\routes;

use Exception;

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
        }

        return $instance;
    }

    /**
     * Add a new GET route
     * @param string $route
     * @param mixed $fn
     */
    public static function get($route, $fn) {
        self::getInstance()->routes['get'][$route] = $fn;
    }

    /**
     * Add a new POST route
     * @param string $route
     * @param mixed $fn
     */
    public static function post($route, $fn) {
        self::getInstance()->routes['post'][$route] = $fn;
    }

    /**
     * Process a request
     * @return void
     */
    public static function doRequest() {
        $oRouter = self::getInstance();
        $oRequest = new Request();
        $sMethodRequest = strtolower($oRequest->getMethod());
        $sUrl = $oRequest->getUrl();

        if (!isset($oRouter->routes[$sMethodRequest][$sUrl])) {
            throw new Exception("O endpoint informado não existe!", 404);
        }

        call_user_func_array($oRouter->routes[$sMethodRequest][$sUrl], [$oRequest]);
    }
}