<?php

namespace App\Repositories;

use App\Interfaces\SchoolRepositoryInterface;
use App\Models\School;

class SchoolRepository implements SchoolRepositoryInterface
{
  public function getAllSchools()
  {
    return School::all();
  }
  public function getSchoolById($schoolId)
  {
    return School::findOrFail($schoolId);
  }
  public function deleteSchool($schoolId)
  {
    School::destroy($schoolId);
  }
  public function createSchool($schoolDetails)
  {
    return School::create($schoolDetails);
  }
  public function updateSchool($schoolId, $newDetails)
  {
    return School::whereId($schoolId)->update($newDetails);
  }

  public function getSchoolByTenant()
  {
    return School::where('tenant_id', app('currentTenant')->id)->first();
  }
}
