<?php

class View {
    public static function make($view) {
        if(Route::isRouteValid()) {
            require_once( '../controllers/'. $view.'.php' );
            require_once( '../views/'. $view.'.php' );
            return 1;
        }
    }
}