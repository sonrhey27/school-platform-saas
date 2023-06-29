import axios from "axios";
import ExamAPIEndPoints from "./endpoints"

const {
  getSubjectList
} = ExamAPIEndPoints();

const ExamAPI = () => {
  const _getSubjectList = async (yearLevelId) => {
    const request = await axios.get(getSubjectList(yearLevelId));
    const response = request.data;

    return response;
  };

  const _createExam = async (endPoint, data) => {
    const request = await axios.post(endPoint, data);
    const response = request.data;
    console.log(response);
  }

  return {
    _getSubjectList,
    _createExam
  }
}

export default ExamAPI;
