<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
      'school_id',
      'year_level_id',
      'subject_id',
      'title'
    ];

    public function subject() {
      return $this->belongsTo(Subject::class);
    }

    public function yearLevel() {
      return $this->belongsTo(YearLevel::class);
    }

    public function examDetails() {
      return $this->hasMany(ExamDetail::class);
    }

    public function examTaken() {
      return $this->hasMany(ExamTaken::class);
    }
}
