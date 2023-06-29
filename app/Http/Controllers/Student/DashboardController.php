<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Interfaces\ExamRepositoryInterface;
use App\Interfaces\StudentRepositoryInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  private ExamRepositoryInterface $examRepository;
  private StudentRepositoryInterface $studentRepository;

  public function __construct(
    ExamRepositoryInterface $examRepository,
    StudentRepositoryInterface $studentRepository
  )
  {
    $this->examRepository = $examRepository;
    $this->studentRepository = $studentRepository;
  }
  public function dashboard()
  {
    $student = $this->studentRepository->getStudentByTenant();
    $exams = $this->examRepository->getExamsByStudentYearLevel($student->year_level_id);
    return view('student.dashboard', compact('exams'));
  }
}
