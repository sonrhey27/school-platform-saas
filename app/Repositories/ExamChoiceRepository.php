<?php

namespace App\Repositories;
use App\Interfaces\ExamChoiceRepositoryInterface;
use App\Models\ExamChoice;

class ExamChoiceRepository implements ExamChoiceRepositoryInterface
{
  public function createExamChoice($examChoiceDetails)
  {
    return ExamChoice::create($examChoiceDetails);
  }
  public function bulkCreateExamChoice($examChoiceDetails)
  {
    return ExamChoice::insert($examChoiceDetails);
  }

  public function checkCorrectAnswer($examDetailId, $choiceId)
  {
    return ExamChoice::where([
      'id' => $choiceId,
      'exam_detail_id' => $examDetailId,
      'is_answer' => true
    ])->first();
  }
}
