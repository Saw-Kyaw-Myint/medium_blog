<?php

namespace App\Services\Auth;

use App\Contracts\Dao\Auth\AuthDaoInterface;
use App\Contracts\Services\Auth\AuthServiceInterface;

/**
 * Service class for post.
 */
class AuthService implements AuthServiceInterface
{
    /**
     * auth dao
     */
    private $authDao;

    /**
     * class constructor
     * @param AuthDaoInterface
     * @return
     */
    public function __construct(AuthDaoInterface $authDao)
    {
        $this->authDao = $authDao;
    }

    /**
     * To store input data
     * @param request
     * @return Object
     */
    public function storePost($request)
    {
        return $this->authDao->storePost($request);
    }

    /**
     * To create input data
     * @param request
     * @return Object
     */
    public function createPost($request)
    {
        return $this->authDao->createPost($request);
    }

    /**
     * To logout
     * @return Object
     */
    public function logoutPost()
    {
        return $this->authDao->logoutPost();
    }

    /**
     * To updatePassword
     * @return Object
     */
    public function updatePasswordPost($request)
    {
        return $this->authDao->updatePasswordPost($request);
    }
}
