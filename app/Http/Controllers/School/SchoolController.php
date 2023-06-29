<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Interfaces\ExamRepositoryInterface;
use App\Interfaces\SchoolRepositoryInterface;
use App\Interfaces\StudentRepositoryInterface;
use App\Interfaces\SubjectRepositoryInterface;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
  private StudentRepositoryInterface $studentRepository;
  private SchoolRepositoryInterface $schoolRepository;
  private ExamRepositoryInterface $examRepository;
  private SubjectRepositoryInterface $subjectRepository;

  public function __construct(
    StudentRepositoryInterface $studentRepository,
    SchoolRepositoryInterface $schoolRepository,
    ExamRepositoryInterface $examRepository,
    SubjectRepositoryInterface $subjectRepository
  )
  {
    $this->studentRepository = $studentRepository;
    $this->schoolRepository = $schoolRepository;
    $this->examRepository = $examRepository;
    $this->subjectRepository = $subjectRepository;
  }
  public function dashboard()
  {
    $school = $this->schoolRepository->getSchoolByTenant();
    $students = $this->studentRepository->getTop5NewStudentsBySchool($school->id);
    $studentRegisterCount = $this->studentRepository->getStudentRegisterCountBySchool($school->id);
    $examCount = $this->examRepository->getExamCountBySchool($school->id);
    $subjectCount = $this->subjectRepository->getSubjectCountBySchool($school->id);
    return view('school.welcome', compact('students', 'studentRegisterCount', 'examCount', 'subjectCount'));
  }
  public function createSubject()
  {
    return view('school.subject.index');
  }
}
