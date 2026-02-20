<?php

namespace App\Http\Controllers;
use App\Http\Request\UserRequest;
use App\Services\UserService;
class UserController
{
    protected $user;
    public function __construct()
    {
        $this->user = new UserService();
    }
    public function uploadcsv(UserRequest $request)
    {
        $params = $request->validated();
        $RES = $this->user->uploadcsv($params);
        if (isset($RES['status']) && $RES['status'] == true) {
            return response()->json($RES, 200);
        } else {
            return response()->json($RES, 500);
        }

    }
}
