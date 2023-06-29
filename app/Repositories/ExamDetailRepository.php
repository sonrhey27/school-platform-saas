<?php

namespace App\Repositories;
use App\Interfaces\ExamDetailRepositoryInterface;
use App\Models\ExamDetail;

class ExamDetailRepository implements ExamDetailRepositoryInterface
{
  public function createExamDetail($examDetails)
  {
    return ExamDetail::create($examDetails);
  }

  public function getExamQuestions($examId)
  {
    return ExamDetail::where('exam_id', $examId)->get();
  }

  public function deleteExamDetail($examDetailId)
  {
    return ExamDetail::find($examDetailId)->delete();
  }
}
