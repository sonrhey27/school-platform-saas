<?php

namespace App\Repositories;
use App\Interfaces\ExamTakenAnswerRepositoryInterface;
use App\Models\ExamTakenAnswer;

class ExamTakenAnswerRepository implements ExamTakenAnswerRepositoryInterface
{
  public function bulkCreateExamTakenAnswer($examTakenAnswerDetails)
  {
    return ExamTakenAnswer::insert($examTakenAnswerDetails);
  }
}
