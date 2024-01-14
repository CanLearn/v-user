<?php

namespace App\Repository\users;

use App\Models\User;

class userRepo
{
    public function index()
    {

    }

    public function getFindId($id)
    {
        return User::query()->findOrFail($id);
    }

    public function getname($name )
    {
        return User::query()->where('name' , $name)->first();
    }
}
