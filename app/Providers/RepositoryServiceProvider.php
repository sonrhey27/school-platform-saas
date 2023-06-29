<?php

namespace App\Providers;

use App\Interfaces\ExamChoiceRepositoryInterface;
use App\Interfaces\ExamDetailRepositoryInterface;
use App\Interfaces\ExamRepositoryInterface;
use App\Interfaces\ExamTakenAnswerRepositoryInterface;
use App\Interfaces\ExamTakenRepositoryInterface;
use App\Interfaces\ExamTypeRepositoryInterface;
use App\Interfaces\SchoolRepositoryInterface;
use App\Interfaces\SchoolUserRepositoryInterface;
use App\Interfaces\StudentRepositoryInterface;
use App\Interfaces\SubjectRepositoryInterface;
use App\Interfaces\TenantRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\YearLevelRepositoryInterface;
use App\Repositories\ExamChoiceRepository;
use App\Repositories\ExamDetailRepository;
use App\Repositories\ExamRepository;
use App\Repositories\ExamTakenAnswerRepository;
use App\Repositories\ExamTakenRepository;
use App\Repositories\ExamTypeRepository;
use App\Repositories\SchoolRepository;
use App\Repositories\SchoolUserRepository;
use App\Repositories\StudentRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\TenantRepository;
use App\Repositories\UserRepository;
use App\Repositories\YearLevelRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
      $this->app->bind(SchoolRepositoryInterface::class, SchoolRepository::class);
      $this->app->bind(SchoolUserRepositoryInterface::class, SchoolUserRepository::class);
      $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
      $this->app->bind(TenantRepositoryInterface::class, TenantRepository::class);
      $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
      $this->app->bind(YearLevelRepositoryInterface::class, YearLevelRepository::class);
      $this->app->bind(SubjectRepositoryInterface::class, SubjectRepository::class);
      $this->app->bind(ExamTypeRepositoryInterface::class, ExamTypeRepository::class);
      $this->app->bind(ExamRepositoryInterface::class, ExamRepository::class);
      $this->app->bind(ExamDetailRepositoryInterface::class, ExamDetailRepository::class);
      $this->app->bind(ExamChoiceRepositoryInterface::class, ExamChoiceRepository::class);
      $this->app->bind(ExamTakenAnswerRepositoryInterface::class, ExamTakenAnswerRepository::class);
      $this->app->bind(ExamTakenRepositoryInterface::class, ExamTakenRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
