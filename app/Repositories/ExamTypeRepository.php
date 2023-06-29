<?php

namespace App\Repositories;
use App\Interfaces\ExamTypeRepositoryInterface;
use App\Models\ExamType;

class ExamTypeRepository implements ExamTypeRepositoryInterface
{
  public function getExamTypes()
  {
    return ExamType::all();
  }
}
