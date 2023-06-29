<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Interfaces\SchoolRepositoryInterface;
use App\Interfaces\SubjectRepositoryInterface;
use App\Interfaces\YearLevelRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    private SubjectRepositoryInterface $subjectRepository;
    private YearLevelRepositoryInterface $yearLevelRepository;
    private SchoolRepositoryInterface $schoolRepository;

    public function __construct(
      SubjectRepositoryInterface $subjectRepository,
      YearLevelRepositoryInterface $yearLevelRepository,
      SchoolRepositoryInterface $schoolRepository
    )
    {
      $this->subjectRepository = $subjectRepository;
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
      $subjects = $this->subjectRepository->getSubjectsBySchool($school->id);
      return view('school.subject.index', compact('yearLevels', 'subjects'));
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
        'year_level_id' => 'required',
      ]);

      if ($validator->fails()) {
        return redirect()
              ->back()
              ->withErrors($validator)
              ->withInput();
      }

      $school = $this->schoolRepository->getSchoolByTenant();
      $subjectDetails = [
        'name' => $request->name,
        'year_level_id' => $request->year_level_id,
        'school_id' => $school->id
      ];
      $this->subjectRepository->createSubject($subjectDetails);

      return redirect()->back()->with('status', 'Subject is created Successfully!');
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
      $validator = Validator::make($request->all(), [
        'name' => 'required',
        'year_level_id' => 'required',
      ]);

      if ($validator->fails()) {
        return redirect()
              ->back()
              ->withErrors($validator)
              ->withInput();
      }

      $subjectDetails = [
        'name' => $request->name,
        'year_level_id' => $request->year_level_id
      ];

      $subjectId = request()->segment(2);

      $this->subjectRepository->updateSubject($subjectId, $subjectDetails);
      return redirect()->back()->with('status', 'Subject is updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $subjectId = request()->segment(2);
      $this->subjectRepository->deleteSubject($subjectId);

      return redirect()->back()->with('status', 'Subject is Deleted Successfully!');
    }

    public function getSubjectList($tenant, $yearLevelId)
    {
      $subjects = $this->subjectRepository->getSubjectByYearLevel($yearLevelId);

      return Response::json($subjects);
    }
}
