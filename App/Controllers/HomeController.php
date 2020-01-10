<?php

namespace App\Controllers;
use App\Services\View\View;


class HomeController
{

    public function __construct()
    {
        // echo ".      I am in HomeController.<br>";
    }

    public function index()
    {
        View::load('index');
    }
}