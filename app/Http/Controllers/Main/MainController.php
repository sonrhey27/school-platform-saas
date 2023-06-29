<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Interfaces\SchoolRepositoryInterface;
use App\Interfaces\SchoolUserRepositoryInterface;
use App\Interfaces\TenantRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    private SchoolRepositoryInterface $schoolRepository;
    private TenantRepositoryInterface $tenantRepository;
    private SchoolUserRepositoryInterface $schoolUserRepository;
    private UserRepositoryInterface $userRepository;

    public function __construct(
      SchoolRepositoryInterface $schoolRepository,
      SchoolUserRepositoryInterface $schoolUserRepository,
      TenantRepositoryInterface $tenantRepository,
      UserRepositoryInterface $userRepository

    )
    {
      $this->schoolRepository = $schoolRepository;
      $this->schoolUserRepository = $schoolUserRepository;
      $this->tenantRepository = $tenantRepository;
      $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      return redirect('schools/create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('main.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      try {
        DB::beginTransaction();
        $name = $request->name;
        $email = $request->email;
        $password = bcrypt($request->password);
        $schoolNameLower = str_replace(' ', '', $name);
        $domain = strtolower($schoolNameLower).'.'.config('tenant.central_url');

        $tenantDetails = [
          'name' => $name,
          'domain' => $domain,
          'database' => $schoolNameLower
        ];
        $tenant = $this->tenantRepository->createTenant($tenantDetails);

        $schoolDetails = [
          'name' => $name,
          'tenant_id' => $tenant->id
        ];
        $school = $this->schoolRepository->createSchool($schoolDetails);

        $userDetails = [
          'email' => $email,
          'password' => $password
        ];
        $user = $this->userRepository->createUser($userDetails);

        $schoolUserDetails = [
          'school_id' => $school->id,
          'user_id' => $user->id
        ];
        $this->schoolUserRepository->createSchoolUser($schoolUserDetails);

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
