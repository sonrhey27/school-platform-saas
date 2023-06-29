<?php

namespace App\Repositories;

use App\Interfaces\SchoolUserRepositoryInterface;
use App\Models\SchoolUser;

class SchoolUserRepository implements SchoolUserRepositoryInterface
{
  public function createSchoolUser($schoolUserDetails)
  {
    return SchoolUser::create($schoolUserDetails);
  }
}
