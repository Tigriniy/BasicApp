<?php

namespace Middlewares;

use Src\Request;
use Src\Auth\Auth;

class RoleMiddleware
{
    public function handle(Request $request, string $role)
    {
        if (!Auth::check()) {
            app()->route->redirect('/login');
            return $request;
        }

        $user = Auth::user();

        if ($user->role !== $role) {
            http_response_code(403);
            echo "<h2 style='color:red; text-align:center; margin-top:50px;'>Доступ запрещён</h2>";
            echo "<p style='text-align:center;'>У вас недостаточно прав. Требуется роль: <strong>" . $role . "</strong></p>";
            echo "<p style='text-align:center;'><a href='" . app()->route->getUrl('/hello') . "'>Вернуться на главную</a></p>";
            exit;
        }

        return $request;
    }
}