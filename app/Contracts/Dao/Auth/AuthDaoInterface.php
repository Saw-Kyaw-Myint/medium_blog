<?php

namespace App\Contracts\Dao\Auth;

use Illuminate\Http\Request;

/**
 * Interface for data accessing object of post
 */
interface AuthDaoInterface
{
    /**
     * To store input data
     * @param request
     * @return Array
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
