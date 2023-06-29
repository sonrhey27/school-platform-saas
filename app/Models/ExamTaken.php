<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamTaken extends Model
{
    use HasFactory;

    protected $fillable = [
      'student_id',
      'exam_id',
      'score',
      'remarks'
    ];

    public function scopefindMyExams($query)
    {
      $student = Student::where('tenant_id', app('currentTenant')->id)->first();
      $query->where('student_id', $student->id);
    }
}
