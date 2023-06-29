<?php

namespace App\Repositories;
use App\Interfaces\SubjectRepositoryInterface;
use App\Models\Subject;

class SubjectRepository implements SubjectRepositoryInterface
{
  public function createSubject($subjectDetails)
  {
    return Subject::create($subjectDetails);
  }

  public function getSubjectsBySchool($schoolId)
  {
    return Subject::with('yearLevel')->where('school_id', $schoolId)->get();
  }

  public function getSubjectByYearLevel($yearLevelId)
  {
    return Subject::where('year_level_id', $yearLevelId)->get();
  }

  public function getSubjectCountBySchool($schoolId)
  {
    return Subject::where('school_id', $schoolId)->count();
  }

  public function deleteSubject($subjectId)
  {
    return Subject::find($subjectId)->delete();
  }

  public function updateSubject($subjectId, $subjectDetails)
  {
    return Subject::find($subjectId)->update($subjectDetails);
  }
}
