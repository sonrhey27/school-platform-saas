<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamTakenAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
      'exam_detail_id',
      'exam_choice_id',
      'student_id',
      'is_answer_correct'
    ];
}
