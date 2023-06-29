<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Interfaces\ExamRepositoryInterface;
use App\Interfaces\ExamTypeRepositoryInterface;
use App\Interfaces\SchoolRepositoryInterface;
use App\Interfaces\SubjectRepositoryInterface;
use App\Interfaces\YearLevelRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    private SubjectRepositoryInterface $subjectRepository;
    private SchoolRepositoryInterface $schoolRepository;
    private YearLevelRepositoryInterface $yearLevelRepository;
    private ExamRepositoryInterface $examRepository;

    public function __construct(
      SubjectRepositoryInterface $subjectRepository,
      SchoolRepositoryInterface $schoolRepository,
      YearLevelRepositoryInterface $yearLevelRepository,
      ExamRepositoryInterface $examRepository
    )
    {
      $this->subjectRepository = $subjectRepository;
      $this->schoolRepository = $schoolRepository;
      $this->yearLevelRepository = $yearLevelRepository;
      $this->examRepository = $examRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $school = $this->schoolRepository->getSchoolByTenant();
      $subjects = $this->subjectRepository->getSubjectsBySchool($school->id);
      $yearLevels = $this->yearLevelRepository->getYearLevelsBySchool($school->id);
      $exams = $this->examRepository->getExamsBySchool($school->id);
      return view('school.exam.index', compact('subjects', 'yearLevels', 'exams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'year_level' => 'required',
        'subject_list' => 'required',
        'title' => 'required',
      ]);

      if ($validator->fails()) {
        return redirect()
              ->back()
              ->withErrors($validator)
              ->withInput();
      }

      $school = $this->schoolRepository->getSchoolByTenant();
      $examDetails = [
        'school_id' => $school->id,
        'year_level_id' => $request->year_level,
        'subject_id' => $request->subject_list,
        'title' => $request->title
      ];

      $exam = $this->examRepository->createExam($examDetails);

      return redirect('exam/'.$exam->id.'/details')->with('status', 'Exam Created!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $examId = request()->segment(2);
      $this->examRepository->deleteExam($examId);

      return redirect()->back()->with('status', 'Exam Deleted Sucessfully!');
    }
}
