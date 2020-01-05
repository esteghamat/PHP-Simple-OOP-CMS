<?php

namespace App\Core;

use App\Utilities\input;

// echo "I am ıncluded.<br>";
// $ff = $_SERVER['REQUEST_METHOD'];
// echo "$ff.<br>";

class Request
{
    public $uri;
    public $referer;
    public $params;
    public $ip;
    public $method;
    public $agent;

    public function __construct()
    {
        if (SANITIZE_ALL_DATA) {
            $this->params = Input::clean($_REQUEST);
        } else {
            $this->params = $_REQUEST;
        }

        $this->uri = $_SERVER['REQUEST_URI']; //$uri_array[0];
        $this->methods = $_SERVER["REQUEST_METHOD"];
        $this->agent = $_SERVER["HTTP_USER_AGENT"];
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->referer = $_SERVER["HTTP_REFERER"] ?? '';
    }

    public function key_exists($propertyname)
    {
        return in_array($propertyname , array_keys($this->params));
    }

    public function is_in($methods_arr)
    {
        return in_array(strtolower($this->methods), $methods_arr);
    }
    
    public function __get($key)
    {
        // echo "<div>propert $name not existed!</div>";
        if ($this->key_exists($key)) {
            return $this->{$key} = $this->params[$key];
        } else {
            // notify programmer
        }    
    }

}
