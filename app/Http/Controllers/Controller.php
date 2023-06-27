<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    function welcomePage()
    {
        return view('welcome', [
            'heading' => 'Welcome Page',
            'posts' => Posts::all()->sortByDesc("date"),
            'users' => User::all()
        ]);
    }

    function welcomeSearch($url)
    {
        $post = Posts::where('url', $url)->firstOrFail();
        $user = User::where('name', $post->author)->firstOrFail();
        return view('unique-post', [
            'post' => $post,
            'user' =>  $user,
        ]);
    }

}
