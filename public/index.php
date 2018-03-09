<?php

require_once('../includes/globals.php');
require_once('../routes/route.php');

function __autoload($class_name) {
    require_once '../includes/config/'. $class_name . '.php';
}

