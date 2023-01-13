<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Contracts\Services\Auth\ForgotServiceInterface;

/**
 * This is auth Controller.
 */
class ForgotPasswordController extends Controller
{
    /**
     * auth interface
     */
    private $forgotInterface;

    /**
     * Create a new controller instance
     *
     * @return void
     */
    public function __construct(ForgotServiceInterface $forgotServiceInterface)
    {
        $this->forgotInterface = $forgotServiceInterface;
    }

    /**
     * To forgot password
     * @return view
     */
    public function forgot()
    {
        return view('auth.forgot');
    }

    /**
     * To store data
     * @param ForgotPasswordRequest
     * @return back
     */
    public function store(ForgotPasswordRequest $request)
    {
        $this->forgotInterface->storePost($request);
        return back()->with('message', 'We have emailed your password reset link!');
    }

    /**
     * To reset passsword
     * @param ForgotPasswordRequest,token
     * @return view
     */
    public function reset(ForgotPasswordRequest $request, $token = null)
    {
        return view('auth.resetPassword')->with(['token' => $token, 'email' => $request->email]);
    }

    /**
     * To create new password
     *@param ResetPasswordRequest
     *@return login
     */
    public function create(ResetPasswordRequest $request)
    {
        $data = $this->forgotInterface->createPost($request);
        if($data){
            return redirect()->route('auth.login')->with('info', 'Your password has been changed!');
        }else{
            return back()->withInput()->with('error', 'Invalid token!');
        }
    }
}
