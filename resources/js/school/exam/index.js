import ExamAPI from "./api";
import Populator from "./populator";

let $yearLevel = $('#year_level'),
    $subjectList = $('#subject_list'),
    $title = $('#title'),
    $examDetails = $('#exam-details'),
    $choice = $('.choice'),
    $chosenAnswer = $('.chosen-answer');

const {
  _getSubjectList,
  _createExam
} = ExamAPI();

const {
  populateSubjectList
} = Populator();

const examDetailForm = {
  _token: null,
  question: null,
  choices: [
    {
      description: null,
      is_answer: false
    },
    {
      description: null,
      is_answer: false
    },
    {
      description: null,
      is_answer: false
    },
    {
      description: null,
      is_answer: false
    }
  ]
}

$yearLevel.on('change', async function() {
  const yearLevelId = $(this).val();

  const subjects = await _getSubjectList(yearLevelId);
  populateSubjectList($subjectList, subjects);
});

$subjectList.on('change', function() {
  $title.prop('disabled', false);
  $title.trigger('focus');
});

$examDetails.on('submit', async function(e) {
  e.preventDefault();

  examDetailForm._token = $(`[name='_token']`).val();
  examDetailForm.question = $('#question').val();
  examDetailForm.choices[0].description = $('#choice-1').val();
  examDetailForm.choices[0].is_answer = $('.choice-1').is(':checked');
  examDetailForm.choices[1].description = $('#choice-2').val();
  examDetailForm.choices[1].is_answer = $('.choice-2').is(':checked');
  examDetailForm.choices[2].description = $('#choice-3').val();
  examDetailForm.choices[2].is_answer = $('.choice-3').is(':checked');
  examDetailForm.choices[3].description = $('#choice-4').val();
  examDetailForm.choices[3].is_answer = $('.choice-4').is(':checked');

  const {
    pathname
  } = window.location;

  await _createExam(pathname, examDetailForm);
});

$choice.on('click', function() {
  const choiceSelected = $(this).attr('class').split(' ').pop();
  $chosenAnswer.removeClass('hidden');
  const selectedAnswer = $(`#${choiceSelected}`).val();
  $chosenAnswer.html(`The selected answer is: ${selectedAnswer}`);
});
