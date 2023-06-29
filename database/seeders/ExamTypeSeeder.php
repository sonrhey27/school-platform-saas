<?php

namespace Database\Seeders;

use App\Models\ExamType;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExamTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      ExamType::insert([
        [
          'name' => 'Fill in the blanks',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'name' => 'Multiple Choice',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ]
      ]);
    }
}
