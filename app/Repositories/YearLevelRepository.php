<?php

namespace App\Repositories;
use App\Interfaces\YearLevelRepositoryInterface;
use App\Models\YearLevel;

class YearLevelRepository implements YearLevelRepositoryInterface
{
  public function createYearLevel($yearLevelDetails)
  {
    return YearLevel::create($yearLevelDetails);
  }
  public function getYearLevelsBySchool($schoolId)
  {
    return YearLevel::where('school_id', $schoolId)->get();
  }
  public function deleteYearLevel($yearLevelId)
  {
    return YearLevel::find($yearLevelId)->delete();
  }
}
