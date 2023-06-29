<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'year_level_id',
      'school_id'
    ];

    public function yearLevel()
    {
      return $this->belongsTo(YearLevel::class);
    }
}
