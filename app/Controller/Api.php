<?php

namespace Controller;

use Model\Post;
use Tigriniy\Framework\Http\Request;
use Src\View;

class Api
{
    public function index(): void
    {
        $posts = Post::all()->toArray();

        (new View())->toJSON($posts);
    }

    public function echo(Request $request): void
    {
        (new View())->toJSON($request->all());
    }
}
