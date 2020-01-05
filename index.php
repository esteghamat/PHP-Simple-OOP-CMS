<?php 

//phpinfo();
include "bootstrap/constants.php";
include "vendor/autoload.php";
include "helpers/global.php";
include "bootstrap/init.php";

//$request = new App\Core\Request();

//echo "<pre>";
//var_dump($request);
//echo "</pre>";

// echo "The user name is : $request->user and his age is $request->age years old.";

$route = new App\Services\Router\Router();

// echo "<pre>";
// var_dump($request->uri);
// echo "</pre>";
// echo "-------------------------<br>";

$really_target = $route->start(/*$request->uri*/);
