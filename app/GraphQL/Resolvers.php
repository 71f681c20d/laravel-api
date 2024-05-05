<?php

namespace App\GraphQL\Resolvers;

use App\Models\User;

class UserResolver
{
    public function users()
    {
        return User::all();
    }

    public function createUser($rootValue, array $args)
    {
        return User::create($args);
    }
}
