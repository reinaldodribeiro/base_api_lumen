<?php

namespace App\Services\User;

use App\Models\User;
use App\Services\CrudService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserService extends CrudService
{
    protected function prepareSave($data)
    {
        $finalData = $data;
        $finalData['password'] = Hash::make(Arr::get($data, 'password'));
        return $finalData;
    }

    protected function getRules($data, $saving, $model)
    {
        $rules = [
            "name" => "required|string|min:3",
            "email" => "required|email|unique:users",
            "password" => "required|min:6"
        ];
        return $rules;
    }

    protected function postSave($model, $data)
    {
        return $model;
    }

    public function getModel($data = [])
    {
        return new User($data);
    }
}
