<?php

namespace App\Interfaces;

interface SchoolRepositoryInterface
{
  public function getAllSchools();
  public function getSchoolById($schoolId);
  public function deleteSchool($schoolId);
  public function createSchool(array $schoolDetails);
  public function updateSchool($schoolId, array $newDetails);
  public function getSchoolByTenant();
}
