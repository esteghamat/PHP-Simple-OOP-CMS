<?php 

//phpinfo();
include "bootstrap/constants.php";
include "vendor/autoload.php";
include "helpers/global.php";
include "bootstrap/init.php";

include "views/templates/header.php";

$route = new App\Services\Router\Router();
$really_target = $route->start();

include "views/templates/footer.php";