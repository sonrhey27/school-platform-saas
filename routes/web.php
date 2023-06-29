<?php

use App\Http\Controllers\Main\MainController;
use App\Http\Controllers\School\ExamController;
use App\Http\Controllers\School\ExamDetailController;
use App\Http\Controllers\School\SchoolController;
use App\Http\Controllers\School\StudentController;
use App\Http\Controllers\School\SubjectController;
use App\Http\Controllers\School\YearLevelController;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\TakeExamController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['domain' => config('app.url')], function () {
  Route::get('/', function () {
      return view('main.index');
  });
  Route::resource('schools', MainController::class);
});

Route::domain('{tenant}.' . config('app.url'))->middleware('tenant')->group(function() {
  Route::get('/', function () {
    return view('school.login');
  });

  Route::get('/register-student', [StudentController::class, 'index']);

  Route::get('/dashboard', [SchoolController::class, 'dashboard']);

  Route::get('/subject/{yearLevelId}/get-subject-list', [SubjectController::class, 'getSubjectList']);

  Route::resource('subject', SubjectController::class);
  Route::resource('student', StudentController::class);
  Route::resource('year-level', YearLevelController::class);
  Route::resource('exam', ExamController::class)->except(['show']);
  Route::resource('exam.details', ExamDetailController::class);
});

Route::domain('{student}.' . '{tenant}.' . config('app.url'))->middleware('tenant')->group(function() {
  Route::get('/', function () {
    return view('student.login');
  });

  Route::get('/dashboard', [DashboardController::class, 'dashboard']);
  Route::resource('/exam', TakeExamController::class);
});
