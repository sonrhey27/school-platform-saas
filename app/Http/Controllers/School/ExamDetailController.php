<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Interfaces\ExamChoiceRepositoryInterface;
use App\Interfaces\ExamDetailRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ExamDetailController extends Controller
{
    private ExamDetailRepositoryInterface $examDetailRepository;
    private ExamChoiceRepositoryInterface $examChoiceRepository;

    public function __construct(
      ExamDetailRepositoryInterface $examDetailRepository,
      ExamChoiceRepositoryInterface $examChoiceRepository
    )
    {
      $this->examDetailRepository = $examDetailRepository;
      $this->examChoiceRepository = $examChoiceRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $examId = request()->segment(2);
      $examDetails = $this->examDetailRepository->getExamQuestions($examId);
      return view('school.exam.details.index', compact('examDetails'));
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

        $validator = Validator::make($request->all(), [
          'question' => 'required',
          'choice' => 'required',
          'choices' => 'required',
        ]);

        if ($validator->fails()) {
          return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $examDetails = [
          'exam_id' => request()->segment(2),
          'question' => $request->question
        ];

        $examDetail = $this->examDetailRepository->createExamDetail($examDetails);

        $examChoices = [];

        foreach ($request->choices as $key => $choice) {
          $is_answer = $request->choice === $key;
          array_push($examChoices, [
            'description' => $choice,
            'exam_detail_id' => $examDetail->id,
            'is_answer' => $is_answer,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
          ]);
        }

        $this->examChoiceRepository->bulkCreateExamChoice($examChoices);

        DB::commit();

        return redirect()->back()->with('status', 'Exam Details Created!');
      } catch (Exception $ex) {
        DB::rollBack();
        dd($ex->getMessage());
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
      $examDetailId = request()->segment(4);
      $this->examDetailRepository->deleteExamDetail($examDetailId);

      return redirect()->back()->with('status', 'Exam Detail Deleted Successfuly!');
    }
}
