<?php

namespace App\Services\View;

class View
{
    const baseView = "views\\"; 

    public static function load($filename , $data = array())
    {
        $filename = str_replace('.' , '\\' , $filename) . '.php';
        $view_path = BASE_PATH . self::baseView . $filename;
        //echo "<br>$filename<br>";
        //echo "<br>$view_path<br>";
        if (file_exists($view_path) && is_readable($view_path)) {
            extract($data);
            include_once $view_path;
        } else {
            echo "Error: view not exists!";
        }
    }
}
