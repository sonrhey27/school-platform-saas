<?php

namespace App\Interfaces;

interface ExamTakenRepositoryInterface
{
  public function createExamTaken(array $examTakenDetails);
}
