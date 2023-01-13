<?php

namespace App\Contracts\Dao\Auth;

use Illuminate\Http\Request;

/**
 * Interface for data accessing object of post
 */
interface ForgotDaoInterface
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
}
