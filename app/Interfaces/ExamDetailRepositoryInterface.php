<?php

namespace App\Interfaces;

interface ExamDetailRepositoryInterface
{
  public function createExamDetail(array $examDetails);
  public function getExamQuestions($examId);
  public function deleteExamDetail($examDetailId);
}
