<?php

namespace App\Repositories;

use App\Interfaces\ExamRepositoryInterface;
use App\Models\Exam;

class ExamRepository implements ExamRepositoryInterface
{
  public function createExam($examDetails)
  {
    return Exam::create($examDetails);
  }

  public function getExamsBySchool($schoolId)
  {
    return Exam::where('school_id', $schoolId)->get();
  }

  public function getExamsByStudentYearLevel($yearLevelId)
  {
    return Exam::where('year_level_id', $yearLevelId)->get();
  }

  public function getExamById($examId)
  {
    return Exam::find($examId);
  }

  public function getExamCountBySchool($schoolId)
  {
    return Exam::where('school_id', $schoolId)->count();
  }

  public function deleteExam($examId)
  {
    return Exam::find($examId)->delete();
  }
}
