<?php

namespace App\Repositories;
use App\Interfaces\ExamTakenRepositoryInterface;
use App\Models\ExamTaken;

class ExamTakenRepository implements ExamTakenRepositoryInterface
{
  public function createExamTaken($examTakenDetails)
  {
    return ExamTaken::create($examTakenDetails);
  }
}
