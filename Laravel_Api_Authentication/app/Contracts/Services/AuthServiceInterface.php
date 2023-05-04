<?php

namespace App\Contracts\Services;

use App\Models\User;

interface AuthServiceInterface
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
     * Save toekn in user table
     *
     * @param string $token
     * @param \App\Models\User $user
     * @return void
     */
    public function saveToken(string $token, User $user): void;
}