<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Interfaces\SchoolRepositoryInterface;
use App\Interfaces\StudentRepositoryInterface;
use App\Interfaces\TenantRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\YearLevelRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    private UserRepositoryInterface $userRepository;
    private StudentRepositoryInterface $studentRepository;
    private SchoolRepositoryInterface $schoolRepository;
    private TenantRepositoryInterface $tenantRepository;
    private YearLevelRepositoryInterface $yearLevelRepository;

    public function __construct(
      UserRepositoryInterface $userRepository,
      StudentRepositoryInterface $studentRepository,
      SchoolRepositoryInterface $schoolRepository,
      TenantRepositoryInterface $tenantRepository,
      YearLevelRepositoryInterface $yearLevelRepository
    )
    {
      $this->userRepository = $userRepository;
      $this->studentRepository = $studentRepository;
      $this->schoolRepository = $schoolRepository;
      $this->tenantRepository = $tenantRepository;
      $this->yearLevelRepository = $yearLevelRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $school = $this->schoolRepository->getSchoolByTenant();
      $yearLevels = $this->yearLevelRepository->getYearLevelsBySchool($school->id);
      return view('school.register-student', compact('yearLevels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      try {
        DB::beginTransaction();
          $name = $request->name;
          $initial = $request->initial;
          $email = $request->email;
          $password = bcrypt($request->password);
          $studentNameLower = str_replace(' ', '', $name);
          $domain = strtolower($studentNameLower).'.'.app('currentTenant')->domain;
          $yearLevelId = $request->year_level_id;

          $userDetails = [
            'email' => $email,
            'password' => $password
          ];
          $user = $this->userRepository->createUser($userDetails);

          $tenantDetails = [
            'name' => $name,
            'domain' => $domain,
            'database' => $studentNameLower
          ];

          $tenant = $this->tenantRepository->createTenant($tenantDetails);

          $studentDetails = [
            'name' => $name,
            'initial' => $initial,
            'school_id' => $this->schoolRepository->getSchoolByTenant()->id,
            'user_id' => $user->id,
            'tenant_id' => $tenant->id,
            'year_level_id' => $yearLevelId
          ];

          $this->studentRepository->createStudent($studentDetails);

        DB::commit();

        return redirect('http://'.$tenant->domain);
      } catch (Exception $ex) {
        DB::rollBack();
        return $ex->getMessage();
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
