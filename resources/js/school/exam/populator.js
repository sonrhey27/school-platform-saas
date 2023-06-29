const Populator = () => {
  const populateSubjectList = (subjectList, subjects) => {
    subjectList.empty();
    subjectList.append(`
      <option disabled selected>Pick one</option>
    `);
    subjects.forEach(subject => {
      subjectList.append(`
        <option value=${subject.id}>${subject.name}</option>
      `);
    });
  }

  return {
    populateSubjectList
  }
}

export default Populator;
