<?php

namespace App\Interfaces;

interface ExamRepositoryInterface
{
  public function createExam(array $examDetails);
  public function getExamsBySchool($schoolId);
  public function getExamsByStudentYearLevel($yearLevelId);
  public function getExamById($examId);
  public function getExamCountBySchool($schoolId);
  public function deleteExam($examId);
}
