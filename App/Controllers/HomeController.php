<?php

namespace App\Controllers;

class HomeController
{

    public function __construct()
    {
        echo "im HomeController";
    }

    public function index()
    {
        echo "I am in Index Method.";
    }
}