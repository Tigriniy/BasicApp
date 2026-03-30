<?php

namespace Middlewares;

use Exception;
use Tigriniy\Framework\Http\Request;
use Src\Session;

class CSRFMiddleware
{
    public function handle(Request $request): void
    {
        if ($request->method !== 'POST') {
            return;
        }

        $postToken = $_POST['csrf_token'] ?? '';
        $sessionToken = $_SESSION['csrf_token'] ?? '';

        if (empty($postToken) || $postToken !== $sessionToken) {

            throw new Exception('Request not authorized');
        }
    }




}