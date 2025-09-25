<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthEmployeeRequest;
use App\Http\Requests\AuthRequest;
use App\Interfaces\AuthInterface;

class AuthController extends Controller
{
    protected $auth;

    public function __construct(AuthInterface $auth)
    {
        $this->auth = $auth;
    }

    public function loginRestaurant(AuthRequest $request)
    {

        return $this->auth->loginRestaurant($request);

    }

    public function loginEmployee(AuthEmployeeRequest $request)
    {

        return $this->auth->loginEmployee($request);

    }

    public function loginAdmin(AuthRequest $request)
    {

        return $this->auth->loginAdmin($request);

    }
}
