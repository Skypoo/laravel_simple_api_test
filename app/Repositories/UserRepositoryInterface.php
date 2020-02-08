<?php


namespace App\Repositories;

use App\Models\User;


interface UserRepositoryInterface
{
    public function all();

    public function create(User $user);
}