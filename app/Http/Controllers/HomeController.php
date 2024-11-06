<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home() {
        $posts = Post::all();
        return view('Home', ['posts'=> $posts]);

    }

    public function calendar() {
        $posts = Post::all();
        return view('Calendar', ['posts'=> $posts]);

    }

}
