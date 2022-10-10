<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use DB;

class PostsController extends Controller
{
    public function show($slug)
    {
        // $posts = DB::table("posts")->where('id',$slug)->first();
        $posts = Posts::where('id',$slug)->firstOrfail();

        dd($posts);

        return view('posts',[
            'post'=>$posts
        ]);
    }
}
