<?php

namespace App\Services\Auth;

use App\Contracts\Dao\Auth\ForgotDaoInterface;
use App\Contracts\Services\Auth\ForgotServiceInterface;

/**
 * Service class for post.
 */
class ForgotService implements ForgotServiceInterface
{
    /**
     * auth dao
     */
    private $forgotDao;

    /**
     * class constructor
     * @param ForgotDaoInterface
     * @return
     */
    public function __construct(ForgotDaoInterface $forgotDao)
    {
        $this->forgotDao = $forgotDao;
    }

    /**
     * To store input data
     * @param request
     * @return Object
     */
    public function storePost($request)
    {
        return $this->forgotDao->storePost($request);
    }

    /**
     * To create input data
     * @param request
     * @return Object
     */
    public function createPost($request)
    {
        return $this->forgotDao->createPost($request);
    }
}
