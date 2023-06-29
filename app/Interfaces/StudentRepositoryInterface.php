<?php

namespace App\Interfaces;

interface StudentRepositoryInterface
{
  public function createStudent(array $studentDetails);
  public function getTop5NewStudentsBySchool($schoolId);
  public function getAllStudents();
  public function getStudentRegisterCountBySchool($schoolId);
  public function getStudentByTenant();
}
