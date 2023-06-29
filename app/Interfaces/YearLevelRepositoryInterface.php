<?php

namespace App\Interfaces;

interface YearLevelRepositoryInterface
{
  public function createYearLevel(array $yearLevelDetails);
  public function getYearLevelsBySchool($schoolId);
  public function deleteYearLevel($yearLevelId);
}
