<?php

namespace App\Repositories;
use App\Interfaces\StudentRepositoryInterface;
use App\Models\Student;

class StudentRepository implements StudentRepositoryInterface
{
  public function createStudent($studentDetails)
  {
    return Student::create($studentDetails);
  }

  public function getTop5NewStudentsBySchool($schoolId)
  {
    return Student::where('school_id', $schoolId)->limit(5)->get();
  }

  public function getAllStudents()
  {
    return Student::all();
  }

  public function getStudentRegisterCountBySchool($schoolId)
  {
    return Student::where('school_id', $schoolId)->count();
  }

  public function getStudentByTenant()
  {
    return Student::where('tenant_id', app('currentTenant')->id)->first();
  }
}
