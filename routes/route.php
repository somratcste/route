<?php

$actual_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if($actual_url)
    var_dump($actual_url);

var_dump($_SERVER["SCRIPT_NAME"]);

function curPageName() {
    return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}


// Prior to 5.4.7 this would show the path as "//www.example.com/path"
var_dump(parse_url($actual_url));

if(curPageName() === 'test.php')
    header("Location: http://localhost/route/public");
