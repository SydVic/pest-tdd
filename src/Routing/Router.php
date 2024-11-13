<?php

namespace App\Routing;

use App\Http\Response;

class Router
{
    public function dispatch(): Response
    {
        return new Response();
    }
}