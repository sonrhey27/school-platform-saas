<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'initial',
      'school_id',
      'user_id',
      'tenant_id',
      'year_level_id'
    ];

    public function tenant() {
      return $this->belongsTo(Tenant::class);
    }
}
