<?php

namespace Middlewares;

use Src\Auth\Auth;
use Tigriniy\Framework\Http\Request;
use Model\User;

class AuthApiMiddleware
{
    public function handle(Request $request)
    {
        $headers = getallheaders();
        $authHeader = $headers['Authorization'] ?? '';

        if (empty($authHeader)) {
            http_response_code(401);
            echo json_encode(['error' => 'Токен не предоставлен']);
            exit();
        }

        $token = str_replace('Bearer ', '', $authHeader);

        if (empty($token)) {
            http_response_code(401);
            echo json_encode(['error' => 'Неверный формат токена']);
            exit();
        }

        $user = User::where('api_token', $token)->first();

        if (!$user) {
            http_response_code(401);
            echo json_encode(['error' => 'Недействительный токен']);
            exit();
        }

        $request->user = $user;

        return $request;
    }
}