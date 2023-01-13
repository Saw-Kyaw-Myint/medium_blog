<?php

namespace App\Dao\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Contracts\Dao\Auth\AuthDaoInterface;
use Illuminate\Support\Arr;
use Symfony\Component\HttpKernel\Profiler\Profile;

/**
 * Data accessing oobject for post
 */
class AuthDao implements AuthDaoInterface
{
    /**
     * To store post
     * @param request
     * @return object
     */
    public function storePost($request)
{
    $user=new User();
    $user->name=$request->name;
    $user->email=$request->email;
    $user->password=Hash::make($request->password);
    $user->bio=$request->bio;
    $user->save();
    }

    /**
     * To create post
     * @param request
     * @return input_data
     */
    public function createPost($request)
    {
        // check if it is email
        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        $credentials = $request->only('email', 'password');
        $input_data = Auth::attempt($credentials);
        return $input_data;
    }

    /**
     * To logout post
     * @return logout
     */
    public function logoutPost()
    {
        $logout = Auth::logout();
        return $logout;
    }

    /**
     * To updatePasswordPost
     * @param request
     * @return data
     */
    public function updatePasswordPost($request)
    {
        $data = User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
        return $data;
    }

    /**
     * request data
     * @param request
     * @return Array
     */
    private function data($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
        ];
    }
}
