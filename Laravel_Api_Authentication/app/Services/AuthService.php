<?php

namespace App\Services;

use App\Models\User;
use App\Contracts\Dao\AuthDaoInterface;
use App\Contracts\Services\AuthServiceInterface;

class AuthService implements AuthServiceInterface
{
    /**
     * Auth Dao
     */
    private $authDao;

    /**
     * Constructor for auth service
     *
     * @param \App\Contracts\Dao\AuthDaoInterface $authDao
     */
    public function __construct(AuthDaoInterface $authDao)
    {
        $this->authDao = $authDao;
    }

    /**
     * Register user
     *
     * @param array $data
     * @return \App\Models\User
     */
    public function register(array $data): User
    {
        return $this->authDao->register($data);
    }

    /**
     * Find user by email
     *
     * @param string $email
     * @return User|null
     */
    public function findUserByEmail(string $email): ?User
    {
        return $this->authDao->findUserByEmail($email);
    }

    /**
     * Save token in user table
     *
     * @param string $token
     * @param User $user
     * @return void
     */
    public function saveToken(string $token, User $user): void
    {
        $this->authDao->saveToken($token, $user);
    }
}