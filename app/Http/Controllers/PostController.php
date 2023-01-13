<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\Comment;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::when(request('q'), function ($p) {
            $q = request("q");
            $p->where("posts.title", "like", "%$q%")->orwhere('posts.description','like',"%$q%");
        }) ->latest('posts.id')->get();
        $latestPosts = Post::offset(0)->limit(3)->get();
        $categories = Category::all();
        return view('post.index', compact(['posts', 'latestPosts', 'categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {

        function textFilter($text)
        {
            $text = trim($text);
            $text = htmlentities($text, ENT_QUOTES);
            $text = stripslashes($text);
            return $text;
        }
        $post = new Post();
        $post->title = $request->title;
        if ($request->hasFile('image')) {
            $newName = uniqid() . "_image." . $request->file('image')->extension();
            $request->file('image')->storeAs('public', $newName);
        }
        $post->user_id = $request->user_id;
        $post->image = $newName;
        $post->description = textFilter($request->description);
        $post->save();
        foreach ($request->category as $key => $cat) {
            $cpost = new CategoryPost();
            $cpost->category_id = $cat;
            $cpost->post_id = $post->id;
            $cpost->save();
        }
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        // return $post->categories()->get();
        $countPosts = Post::where('posts.user_id', '=', $post->user_id)->get();
//         $relatedPosts=[];
//   foreach ($post->categories()->get() as $key => $value) {
//    array_push($relatedPosts ,Post::Join('category_posts', 'posts.id', '=', 'category_posts.post_id')
//     ->join('categories', 'categories.id', '=', 'category_posts.category_id')
//     ->where('categories.ctitle', '=',$value->ctitle)
//     ->select('categories.ctitle', 'posts.*')->get());
//   }
    //    $categories=Category::all();
    //   return   $categories->posts()->get();

        // return $relatedPosts;
        $commentsTotal = Comment::where('comments.commentable_id', '=', $id)->get();
        return view('post.detail', compact(['post', 'countPosts',
            // 'relatedPosts',
            'commentsTotal']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories=Category::all();
        $post=Post::find($id);
        return view('post.edit',compact(['post','categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {

    //   return $request;
        $post=Post::find($id);
        $post->title = $request->title;
        $categories= $request->category;
          foreach($categories as $cat){
            $cpost = new CategoryPost();
            $cpost ->post_id= $id;
            $cpost->category_id= $cat;
            $cpost->save();
         }
        if ($request->hasFile('image')) {
            $updName = uniqid() . "_image." . $request->file('image')->extension();
            $request->file('image')->storeAs('public', $updName);
        } else {
            $updName = $post->image;
        }
        $post->image = $updName;
        $post->description = $request->description;
        $post->update();

        return redirect()->route('post.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::find($id);
        $post->delete();
        return back();
    }

    public function profileDel($id)
    {
        $delpost = Post::find($id);
        $delpost->delete();
        return redirect()->route('user.profile');
    }
}
