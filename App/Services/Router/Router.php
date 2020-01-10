<?php

namespace App\Services\Router;
use App\Core\Request;
//use App\Services\View\View;


class Router
{
    public static $routes;
    public static $current_route;
    const baseController = "App\\Controllers\\";
    const baseMiddleware = "App\\Middlewares\\";

    public function __construct()
    {
        self::$routes = self::get_all_routes();
        self::$current_route = self::get_current_route();
        // echo "<pre>";
        // var_dump(self::$routes);
        // echo "</pre>";        
        // echo "<pre>";
        // var_dump(self::$current_route);
        // echo "</pre>";   
    }

    public function start()
    {
        // echo "Router Starts!";
        // 1- get all routes (load address book)
            // it is done in construct

        // 2- check if user route exists in our valid routes lists
        if (!(self::route_exists(self::$current_route))) 
        {
            $cr = self::$current_route;
            echo "Route $cr not found!!<br>";
            header("HTTP/1.0 404 Not Found");
            echo "errors.404";
            //View::load('errors.404');
            die();
        }

        // uri os valid then : create new request.  
        $request = new Request();
        // 3- Load our allowded methods from our list for this uri
        $allowed_methods = self::get_route_methods(self::$current_route);
        // 3-1 check the user request's method that is in our alowded list or not ? 
        //echo "<pre>";
        //var_dump($allowed_methods);
        //echo "</pre>";        
        if (!$request->is_in($allowed_methods)) {
            echo "Method (Post or Get or Put) not found!!1<br>";
            header('HTTP/1.0 403 Forbidden');
            echo "errors.403";
            //View::load('errors.403');
            die();
        }

        // 4- Check for middleware 
        // 4-1 in our list, this uri has Middleawre ? 
        switch (self::has_middleware(self::$current_route))
        {
            case 'There_is_Middleware_for_this_route': 
                $middelewares = self::get_route_middlewares(self::$current_route);
                //var_dump($middelewares);
                // 4-2 check classes for middleware 
                foreach ($middelewares as $middeleware) 
                {
                    $middlewareClass = self::baseMiddleware . $middeleware;
                    if (!class_exists($middlewareClass)) {
                        echo "Error: Class '$middlewareClass' was not found!";
                        die();
                    }
                    // 4-3 create new middlewares and call handle method 
                    $middlewareObj = new $middlewareClass;
                    $middlewareObj->handle($request);
                }
            break;
            
            case 'There_is_Global_Middleware':
                $middelewares = explode('|', GLOBAL_MIDDLEWARES);
                //var_dump($middelewares);
                // 4-2 check classes for middleware 
                foreach ($middelewares as $middeleware) 
                {
                    $middlewareClass = self::baseMiddleware . $middeleware;
                    if (!class_exists($middlewareClass)) {
                        echo "Error: Class '$middlewareClass' was not found!";
                        die();
                    }
                    // 4-3 create new middlewares and call handle method 
                    $middlewareObj = new $middlewareClass;
                    $middlewareObj->handle($request);
                }
            break;

            case 'No_middleware':
            break;
        }

        // 5- check for controllers and it's methods 
        $targetStr = self::get_route_target(self::$current_route);
        list($controller, $method) =  explode('@', $targetStr);
        $controller = self::baseController . $controller;
        // 5-1 check for controller class
        if (!class_exists($controller)) {
            echo "Error: Class '$controller' was not found!";
            die();
        }
        // 5-2 create object of controller 
        $controllerObject = new $controller;
        // 5-3 check for controller methods
        if (!method_exists($controllerObject, $method)) {
            echo "Error: Method '$method' was not found in '$controller' !";
            die();
        }
        // 5-4 Call controller's method
        $controllerObject->$method($request);

    }

    public static function get_all_routes()
    {
        return include BASE_PATH . "routes\\web.php";
    }

    public static function get_current_route()
    {
        $current_uri = str_replace(strtolower(SUB_DIRECTORY), '', strtolower($_SERVER['REQUEST_URI']));
        if($current_uri === '')
        {
            $current_uri = '/';
        }
        return strtok($current_uri, '?');
    }

    public static function route_exists($route)
    {
        return in_array($route, array_keys(self::$routes));
    }
    
    public static function get_route_methods($route)
    {
        if(array_key_exists('method' , self::$routes[$route]))
        {
            $methods_str = self::$routes[$route]['method'];
            return explode('|', $methods_str); 
        }
        else
        {
            return null;
        }
    }

    public static function get_route_target($route)
    {
        return self::$routes[$route]['target'];
    }

    public static function get_route_middlewares($route)
    {
        if(array_key_exists('middleware' , self::$routes[$route]))
        {
            $str_middlewares = self::$routes[$route]['middleware']; 
            return explode('|', $str_middlewares); 
        }
        else
        {
            return null;
        }
    }

    public static function has_middleware($route)
    {
        if(array_key_exists('middleware' , self::$routes[$route]))
        {
            return 'There_is_Middleware_for_this_route';
        }
        if(!empty(GLOBAL_MIDDLEWARES))
        {
            return 'There_is_Global_Middleware';
        }
        return 'No_middleware';
    }


}