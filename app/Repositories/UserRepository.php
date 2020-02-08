<?php


namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function create($input)
    {
        return $this->user->create($input);
    }

    public function delete($account)
    {
        return $this->user->where('account', $account)->delete();
    }

    public function resetPassword($input, $account)
    {

        return $this->user->where('account', $account)->update($input);
    }

    public function checkLogin($account, $password)
    {
        return $this->user->where('account', $account)->where('password', $password)->first();
    }
}