<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfileUpdateRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('posts.user_id', '=', Auth::user()->id)->get();
        $latestPosts = Post::latest('id')->offset(0)->limit(3)->get();
        $categories=Category::all();
        return view('user.profile', compact(['posts', 'latestPosts','categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserProfileUpdateRequest $request)
    {

        // dd($request)
        if ($request->hasFile('profile')) {
            $newName = uniqid() . "_image." . $request->file('profile')->extension();
            $request->file('profile')->storeAs('public', $newName);
        }
        else{
            $newName=Auth::user()->profile;
        }
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->bio = $request->input('bio');
        $user->profile = $newName;
        $user->save();
        return back()->with('message', 'Profile Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function updatePassword(Request $request)
    {
         $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required',
                Password::min(6)
                    ->letters()
                    ->mixedCase()
                    ->numbers()],
            'confirm_password' => ['required', 'same:new_password'],
        ]);

        // dd($request);
        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
        return redirect()->route('user.profile')->with('success_message', 'Password change successfully.');
    }
}
