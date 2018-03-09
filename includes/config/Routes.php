<?php

class Route {

    public static function isRouteValid() {
        global $routes;
        $uri = $_SERVER['REQUEST_URI'];

        if (!in_array(explode('?',$uri)[0], $routes)) {
            return 0;
        } else {
            return 1;
        }
    }

    private static function registerRoute($route) {
        global $routes;
        $routes[] = base_url. $route;
    }

    public static function dyn($dyn_routes) {
        $route_components = explode('/', $dyn_routes);
        $uri_components = explode('/', substr($_SERVER['REQUEST_URI'], strlen(BASEDIR)-1));
        for ($i = 0; $i < count($route_components); $i++) {
            if ($i+1 <= count($uri_components)-1) {
                $route_components[$i] = str_replace("<$i>", $uri_components[$i+1], $route_components[$i]);
            }
        }
        $route = implode($route_components, '/');
        return $route;
    }

    public static function set($route, $closure) {
        if ($_SERVER['REQUEST_URI'] == base_url.$route) {
            self::registerRoute($route);
            $closure->__invoke();
        } else if (explode('?', $_SERVER['REQUEST_URI'])[0] == base_url.$route) {
            self::registerRoute($route);
            $closure->__invoke();
        } else if ($_GET['url'] == explode('/', $route)[0]) {
            self::registerRoute(self::dyn($route));
            $closure->__invoke();
        }
    }


}