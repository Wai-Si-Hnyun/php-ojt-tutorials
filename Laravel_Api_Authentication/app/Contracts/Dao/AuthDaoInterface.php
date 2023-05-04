<?php

namespace App\Contracts\Dao;

use App\Models\User;

interface AuthDaoInterface
{
    /**
     * Register user
     *
     * @param array $data
     * @return \App\Models\User
     */
    public function register(array $data): User;

    /**
     * Find user by email
     *
     * @param string $email
     * @return User|null
     */
    public function findUserByEmail(string $email): ?User;

    /**
     * Save token in user table
     *
     * @param string $token
     * @param User $user
     * @return void
     */
    public function saveToken(string $token, User $user): void;
}