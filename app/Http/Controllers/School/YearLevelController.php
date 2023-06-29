<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Interfaces\SchoolRepositoryInterface;
use App\Interfaces\YearLevelRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class YearLevelController extends Controller
{
    private YearLevelRepositoryInterface $yearLevelRepository;
    private SchoolRepositoryInterface $schoolRepository;

    public function __construct(
      YearLevelRepositoryInterface $yearLevelRepository,
      SchoolRepositoryInterface $schoolRepository
    )
    {
      $this->yearLevelRepository = $yearLevelRepository;
      $this->schoolRepository = $schoolRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $school = $this->schoolRepository->getSchoolByTenant();
      $yearLevels = $this->yearLevelRepository->getYearLevelsBySchool($school->id);
      return view('school.year-level.index', compact('yearLevels'));
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
      $validator = Validator::make($request->all(), [
        'name' => 'required',
        'adviser' => 'required',
      ]);

      if ($validator->fails()) {
        return redirect()
              ->back()
              ->withErrors($validator)
              ->withInput();
      }

      $school = $this->schoolRepository->getSchoolByTenant();
      $yearLevelDetails = [
        'name' => $request->name,
        'adviser' => $request->adviser,
        'school_id' => $school->id
      ];

      $this->yearLevelRepository->createYearLevel($yearLevelDetails);

      return redirect()->back()->with('status', 'Year Level Created Sucessfuly!');
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
