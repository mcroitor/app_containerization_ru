<?php

namespace mc;

use Exception;

/**
 * this router class is based on $_GET
 * <URL> ::= http[s]://<domain>/?<route-name>[/params]
 */
class router {

    private const ATTRIBUTE_NAME = \mc\route::class;

    private static $routes = [];
    private static $param = "q";
    private static $default = "/";

    /**
     * set routes
     * @param array $routes
     */
    public static function init(array $routes = []) {
        self::$routes[self::$default] = function () {
            return "";
        };
        self::scanClasses();
        self::scanFunctions();
        foreach ($routes as $route_name => $route_method) {
            self::register($route_name, $route_method);
        }
    }

    /**
     * scan classes. select all static methods and check attributes
     */
    private static function scanClasses() {
        $classes = \get_declared_classes();
        foreach ($classes as $class) {
            $reflection = new \ReflectionClass($class);
            $methods = $reflection->getMethods(\ReflectionMethod::IS_STATIC);
            foreach ($methods as $method) {
                self::registerMethod($method);
            }
        }
    }

    /**
     * scan functions. check attributes
     */
    private static function scanFunctions() {
        $functions = \get_defined_functions();
        foreach ($functions['user'] as $function) {
            $reflection = new \ReflectionFunction($function);
            self::registerMethod($reflection);
        }
    }

    /**
     * if method or function has `route` attribute, register it
     * @param type $reflection
     */
    private static function registerMethod($reflection) {
        $attribute = self::getMethodAttribute($reflection, self::ATTRIBUTE_NAME);
        if ($attribute != null) {
            $route = $attribute->getArguments()[0];
            self::register($route, $reflection->getClosure());
        }
    }

    private static function getMethodAttribute($method, $attributeName) {
        /** @var ReflectionAttribute $attributes */
        $attributes = $method->getAttributes();
        foreach ($attributes as $attribute) {
            if ($attribute->getName() == $attributeName) {
                return $attribute;
            }
        }
        return null;
    }

    /**
     * load routes from JSON file
     */
    public static function load(string $jsonfile = "routes.json") {
        $routes = json_decode(file_get_contents($jsonfile));
        self::init((array) $routes);
    }

    /**
     * register a new route.
     * If $route_method is null, the $route_name will be
     */
    public static function register(string $route_name, callable $route_method) {
        if (is_callable($route_method) === false) {
            throw new Exception("`{$route_method}` is not callable");
        }
        self::$routes[$route_name] = $route_method;
    }

    /**
     * rewrite default param name
     */
    public static function set_param(string $param) {
        self::$param = $param;
    }

    /**
     * entry point for routing!
     */
    public static function run() {
        $path = filter_input(INPUT_GET, self::$param, FILTER_DEFAULT, ["default" => self::$default]);
        if (empty($path)) {
            $path = self::$default;
        }
        $chunks = explode("/", $path);

        // two-word label
        if (count($chunks) > 1 && isset(self::$routes["{$chunks[0]}/{$chunks[1]}"])) {
            $route_name = "{$chunks[0]}/{$chunks[1]}";
            array_shift($chunks);
            array_shift($chunks);

            return self::$routes[$route_name]($chunks);
        }

        // one-word label
        if (isset(self::$routes[$chunks[0]])) {
            $route_name = $chunks[0];
            array_shift($chunks);

            return self::$routes[$route_name]($chunks);
        }
        return self::$routes[self::$default]();
    }

    public static function getRoutes() {
        return array_keys(self::$routes);
    }
}
