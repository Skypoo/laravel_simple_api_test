<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function test(Request $request)
    {
        $input = [
            'account' => 'User01',
            'password' => '123456',
            'token' => md5('test')
        ];

        $test = $this->user->where('id', 1)->get();

        dd($test);
    }


}
