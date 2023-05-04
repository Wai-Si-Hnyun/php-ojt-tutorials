<?php

namespace App\Dao;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Contracts\Dao\AuthDaoInterface;

class AuthDao implements AuthDaoInterface
{
    /**
     * Register user
     *
     * @param array $data
     * @return \App\Models\User
     */
    public function register(array $data): User
    {
        $data = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ];
        
       return User::create($data);
    }

    /**
     * Find user by id
     *
     * @param string $email
     * @return User|null
     */
    public function findUserByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
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
        $user->remember_token = $token;
        $user->save();
    }
}