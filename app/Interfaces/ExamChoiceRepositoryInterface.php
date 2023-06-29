<?php

namespace App\Interfaces;

interface ExamChoiceRepositoryInterface
{
  public function createExamChoice(array $examChoiceDetails);
  public function bulkCreateExamChoice(array $examChoiceDetails);
  public function checkCorrectAnswer($examDetailId, $choiceId);
}
