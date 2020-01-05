<?php

return array(
    '/' => 
        [
            'method' => 'get',
            'target' => 'HomeController@index'
        ] ,
    'auth/login' => 
        [
            'method' => 'get|post',
            'target' => 'AuthController@login',
            'middleware' => 'IEBlocker'
        ],
    'auth/register' => 
        [
            'method' => 'post',
            'target' => 'AuthController@register'
        ]
);


