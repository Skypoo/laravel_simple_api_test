<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $userRepository;
    public function __construct()
    {
        $this->userRepository = new UserRepository(new User());
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Account' => 'required|string|max:50|unique:user,account',
            'Password' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            $result = [
                'Code' => 200,
                'Message' => $validator->errors()->toArray(),
                'Result' => [
                    'IsOK' => false
                ]
            ];
            return response()->json($result, 200, array('Content-Type' => 'application/json'));
        }

        try {
            $input = [
                'account' => $request['Account'],
                'password' => $request['Password']
            ];

            $this->userRepository->create($input);

            $result = [
                'Code' => 0,
                'Message' => 'Success',
                'Result' => [
                    'IsOK' => true
                ]
            ];
            return response()->json($result, 200, array('Content-Type' => 'application/json'));
        } catch (\Exception $e) {
            $result = [
                'Code' => 100,
                'Message' => 'fail',
                'Result' => [
                    'IsOK' => false
                ]
            ];

            return response()->json($result, 200, array('Content-Type' => 'application/json'));
        }
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Account' => 'required|string|max:50|exists:user,account',
        ]);

        if ($validator->fails()) {
            $result = [
                'Code' => 200,
                'Message' => $validator->errors()->toArray(),
                'Result' => [
                    'IsOK' => false
                ]
            ];
            return response()->json($result, 200, array('Content-Type' => 'application/json'));
        }

        try {
            $this->userRepository->delete($request['Account']);

            $result = [
                'Code' => 0,
                'Message' => 'Success',
                'Result' => [
                    'IsOK' => true
                ]
            ];
            return response()->json($result, 200, array('Content-Type' => 'application/json'));
        } catch (\Exception $e) {
            $result = [
                'Code' => 100,
                'Message' => 'fail',
                'Result' => [
                    'IsOK' => false
                ]
            ];

            return response()->json($result, 200, array('Content-Type' => 'application/json'));
        }
    }

    public function change(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Account' => 'required|string|max:50|exists:user,account',
            'Password' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            $result = [
                'Code' => 200,
                'Message' => $validator->errors()->toArray(),
                'Result' => [
                    'IsOK' => false
                ]
            ];
            return response()->json($result, 200, array('Content-Type' => 'application/json'));
        }

        try {
            $this->userRepository->resetPassword(['password' => $request['Password']], $request['Account']);

            $result = [
                'Code' => 0,
                'Message' => 'Success',
                'Result' => [
                    'IsOK' => true
                ]
            ];
            return response()->json($result, 200, array('Content-Type' => 'application/json'));
        } catch (\Exception $e) {
            $result = [
                'Code' => 100,
                'Message' => 'fail',
                'Result' => [
                    'IsOK' => false
                ]
            ];

            return response()->json($result, 200, array('Content-Type' => 'application/json'));
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Account' => 'required|string|max:50|exists:user,account',
            'Password' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            $result = [
                'Code' => 200,
                'Message' => $validator->errors()->toArray(),
                'Result' => [
                    'IsOK' => false
                ]
            ];
            return response()->json($result, 200, array('Content-Type' => 'application/json'));
        }

        try {
            $user = $this->userRepository->checkLogin($request['Account'], $request['Password']);

            if ($user) {
                $status = 200;
                $result = [
                    'Code' => 0,
                    'Message' => 'Success',
                    'Result' => null
                ];
            } else {
                $status = 400;
                $result = [
                    'Code' => 2,
                    'Message' => 'Login Failed',
                    'Result' => null
                ];
            }

            return response()->json($result, $status, array('Content-Type' => 'application/json'));
        } catch (\Exception $e) {
            $result = [
                'Code' => 100,
                'Message' => 'fail',
                'Result' => [
                    'IsOK' => false
                ]
            ];

            return response()->json($result, 200, array('Content-Type' => 'application/json'));
        }
    }
}
