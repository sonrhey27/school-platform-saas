<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamChoice extends Model
{
    use HasFactory;

    protected $fillable = [
      'description',
      'exam_detail_id',
      'is_answer'
    ];
}
