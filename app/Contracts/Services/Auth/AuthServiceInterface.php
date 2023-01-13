<?php

namespace App\Contracts\Services\Auth;

use Illuminate\Http\Request;

/**
 * Interface for post service
 */
interface AuthServiceInterface
{
    /**
     * To store input data
     * @param request
     * @return Object
     */
    public function storePost($request);

    /**
     * To create input data
     * @param request
     * @return Object
     */
    public function createPost($request);

    /**
     * To logout
     * @return Object
     */
    public function logoutPost();

    /**
     * To updatePassword
     * @return Object
     */
    public function updatePasswordPost($request);
}
