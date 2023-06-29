<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Interfaces\ExamChoiceRepositoryInterface;
use App\Interfaces\ExamRepositoryInterface;
use App\Interfaces\ExamTakenAnswerRepositoryInterface;
use App\Interfaces\ExamTakenRepositoryInterface;
use App\Interfaces\StudentRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TakeExamController extends Controller
{
    private ExamRepositoryInterface $examRepository;
    private StudentRepositoryInterface $studentRepository;
    private ExamChoiceRepositoryInterface $examChoiceRepository;
    private ExamTakenAnswerRepositoryInterface $examTakenAnswerRepository;
    private ExamTakenRepositoryInterface $examTakenRepository;

    public function __construct(
      ExamRepositoryInterface $examRepository,
      StudentRepositoryInterface $studentRepository,
      ExamChoiceRepositoryInterface $examChoiceRepository,
      ExamTakenAnswerRepositoryInterface $examTakenAnswerRepository,
      ExamTakenRepositoryInterface $examTakenRepository
    )
    {
      $this->examRepository = $examRepository;
      $this->studentRepository = $studentRepository;
      $this->examChoiceRepository = $examChoiceRepository;
      $this->examTakenAnswerRepository = $examTakenAnswerRepository;
      $this->examTakenRepository = $examTakenRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

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
      try {
        DB::beginTransaction();
        $correctAnswerCount = 0;
        $remarks = '';
        $student = $this->studentRepository->getStudentByTenant();
        $examArray = $request->all();
        $questionIds = $request->question_ids;
        $examId = $request->exam_id;

        $exam = $this->examRepository->getExamById($examId);
        $totalNumberOfQuestions = $exam->examDetails()->count();

        $takenAnswerDetails = [];
        foreach ($questionIds as $questionId)
        {
          $selectedChoice = $examArray['choice_'.$questionId];
          $checkAnswer = !is_null($this->examChoiceRepository->checkCorrectAnswer($questionId, $selectedChoice));
          if ($checkAnswer) {
            $correctAnswerCount += 1;
          }
          array_push($takenAnswerDetails, [
            'exam_detail_id' => $questionId,
            'exam_choice_id' => $selectedChoice,
            'student_id' => $student->id,
            'is_answer_correct' => $checkAnswer,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
          ]);
        }

        $score = $correctAnswerCount;
        $percentage = round(($correctAnswerCount / $totalNumberOfQuestions) * 100, 2);

        if ($percentage >= 75) {
          $remarks = 'Passed';
        } else {
          $remarks = 'Fail';
        }

        $examTakenDetails = [
          'student_id' => $student->id,
          'exam_id' => $examId,
          'score' => $score,
          'remarks' => $remarks
        ];

        $this->examTakenAnswerRepository->bulkCreateExamTakenAnswer($takenAnswerDetails);
        $this->examTakenRepository->createExamTaken($examTakenDetails);

        DB::commit();

        return redirect('/dashboard');

      } catch (Exception $ex) {
        Db::rollBack();
        dd($ex->getMessage());
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      $examId = request()->segment(2);
      $exam = $this->examRepository->getExamById($examId);
      return view('student.exam.index', compact('exam'));
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
        //
    }
}
