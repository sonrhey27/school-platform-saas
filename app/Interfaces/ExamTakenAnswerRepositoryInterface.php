<?php

namespace App\Interfaces;


interface ExamTakenAnswerRepositoryInterface
{
  public function bulkCreateExamTakenAnswer(array $examTakenAnswerDetails);
}
