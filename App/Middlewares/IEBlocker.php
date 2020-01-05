<?php

namespace App\Middlewares;
use App\Middlewares\Contract\BaseMiddleware;
use App\Core\Request;

class IEBlocker extends BaseMiddleware
{
    public function handle(Request $request)
    {
        $agentKey = 'Trident/';
        if (stripos($request->agent, $agentKey) !== false) 
        {
            echo "Sorry, IE was Blocked , hahahaa ...";
            die();
        }
    }
}