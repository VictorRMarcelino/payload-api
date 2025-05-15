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

    protected $routes = [
        Request::METHOD_GET  => [],
        Request::METHOD_POST => []
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
     * Add a new GET route
     * @param string $route
     * @param mixed $fn
     */
    public static function get($route, $fn) {
        self::getInstance()->routes[Request::METHOD_GET][$route] = $fn;
    }

    /**
     * Add a new POST route
     * @param string $route
     * @param mixed $fn
     */
    public static function post($route, $fn) {
        self::getInstance()->routes[Request::METHOD_POST][$route] = $fn;
    }

    /**
     * Process a request
     * @return void
     */
    public static function doRequest() {
        $oRouter        = self::getInstance();
        $oRequest       = Request::getInstance();
        $sMethodRequest = strtolower($oRequest->getMethod());
        $sUrl           = $oRequest->getUrl();

        if (!isset($oRouter->routes[$sMethodRequest][$sUrl])) {
            throw new Exception("O endpoint informado não existe!", 404);
        }

        call_user_func_array($oRouter->routes[$sMethodRequest][$sUrl], [$oRequest]);
    }

    /**
     * Send a response to the request
     * @param array $aData
     * @param int $iCode
     * @return void
     */
    public static function response(array $aData, $iCode = 200) {
        if (!is_integer($iCode)) {
            $iCode = 500;
        }
        
        http_response_code($iCode);
        echo json_encode($aData);
    }
}