<?php

namespace Middlewares;

use Src\Auth\Auth;
use Tigriniy\Framework\Http\Request;

class GuestMiddleware
{
    public function handle(Request $request): void
    {
        if (Auth::check()) {

            header('Location: ' . app()->route->getUrl('/hello'));
            exit();
        }
    }
}