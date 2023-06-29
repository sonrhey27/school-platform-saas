<?php

namespace App\Interfaces;

interface SubjectRepositoryInterface
{
  public function createSubject(array $subjectDetails);
  public function getSubjectsBySchool($schoolId);
  public function getSubjectByYearLevel($yearLevelId);
  public function getSubjectCountBySchool($schoolId);
  public function deleteSubject($subjectId);
  public function updateSubject($subjectId, $subjectDetails);
}
