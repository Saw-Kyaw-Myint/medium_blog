<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class CategoryController extends Controller
{
    public function search($category)
    {
        $posts = Post::Join('category_posts', 'posts.id', '=', 'category_posts.post_id')
        ->join('categories','categories.id','=','category_posts.category_id')
        -> where('categories.ctitle', '=', $category)
        ->select('categories.ctitle', 'posts.*')->get();
        $latestPosts = Post::Join('users', 'users.id', '=', 'posts.user_id')
            ->select('users.*', 'posts.*')->latest('posts.id')->offset(0)->limit(3)->get();
            $categories=Category::all();
        return view('post.index', compact('posts', 'latestPosts','categories'));
    }

}
