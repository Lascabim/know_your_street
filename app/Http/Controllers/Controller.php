<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

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
    
    function profilePage()
    {
        $name = Auth::user()->name;

        $posts = Posts::all()->where('author', $name);
        $user = User::where('name', $name)->firstOrFail();
        return view('profile', [
            'posts' => $posts,
            'user' =>  $user,
        ]);
    }

    function profileSearch($name)
    {
        $posts = Posts::all()->where('author', $name);
        $user = User::where('name', $name)->firstOrFail();
        return view('profile', [
            'posts' => $posts,
            'user' =>  $user,
        ]);
    }

    function deletePost($id)
    {
        $post = Posts::find($id);

        if ($post) {
            $imagePath = public_path($post->image_path);
            File::delete($imagePath);
    
            $post->delete();
            return back()->with('success', 'Post deletado com sucesso.');
        } else {
            return back()->with('error', 'Post não encontrado.');
        }
    }
}
