<?php

namespace App\Dao\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Contracts\Dao\Auth\ForgotDaoInterface;

/**
 * Data accessing oobject for post
 */
class ForgotDao implements ForgotDaoInterface
{
    /**
     * To store post
     * @param request
     * @return object
     */
    public function storePost($request)
    {
        $token = Str::random(20);
        $data = DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        $action_link = route('forgot.reset', ['token' => $token, 'email' => $request->email]);
        $body = "We are recevied a request to reset the password for <b> One click </b> acount associated with <b>" . $request->email .
            "</b> .You can reset your by password clicking the link below. ";
        $mail = Mail::send(
            'auth.forget-password-email',
            ['action_link' => $action_link, 'body' => $body],
            function ($message) use ($request) {
                $message->from('tinhtarwai106330@gmail.com', 'One Click');
                $message->to($request->email)
                    ->subject('Reset Password confirmation');
            }
        );
        return compact('data', 'mail');
    }

    /**
     * To create post
     * @return request
     * @return Object
     */
    public function createPost($request)
    {
        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token,
            ])
            ->first();
        if (!$updatePassword) {
            return false;
        }else{
            $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);
        $data = DB::table('password_resets')->where(['email' => $request->email,'token'=>$request->token])->delete();
        return true;
        }
    }
}
