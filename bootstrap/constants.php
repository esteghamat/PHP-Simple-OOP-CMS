<?php

define('BASE_URL' , "http://localhost/MyApps/CMS_OOP/");
define('BASE_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('BASE_URI' , "/MyApps/CMS_OOP/");
define('SUB_DIRECTORY', '/MyApps/CMS_OOP/');
define('CSS_PATH', 'bootstrap/style/css/');
define('JS_PATH', 'bootstrap/style/js/');
define('IMAGE_PATH', 'bootstrap/images/');

define('BASE_VIEW_PATH', BASE_PATH . 'views' . DIRECTORY_SEPARATOR);

define('IS_DEV_MODE', 1);
define('SANITIZE_ALL_DATA', 0);
define('GLOBAL_MIDDLEWARES', 'IEBlocker');
