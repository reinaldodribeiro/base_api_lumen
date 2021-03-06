<?php


namespace App\Http\Controllers\User;


use App\Http\Controllers\CrudController;
use App\Services\User\UserService;

class UserController extends CrudController
{
    public function __construct(UserService $service) {
        $this->service = $service;
    }
}
