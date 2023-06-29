const ExamAPIEndPoints = () => {
  const getSubjectList = (yearLevelId) => {
    return `/subject/${yearLevelId}/get-subject-list`;
  }

  return {
    getSubjectList
  }
}

export default ExamAPIEndPoints;
