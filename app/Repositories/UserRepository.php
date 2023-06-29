<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
  public function createUser($userDetails)
  {
    return User::create($userDetails);
  }
}
