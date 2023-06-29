@extends('school.app')
@section('content')
<div class="dashboard-wrapper">
  <div class="card bg-base-100 shadow-xl w-full">
    <div class="card-body">
      <h2 class="card-title">Create an Exam Details</h2>
      <div class="divider"></div>
      <form id="exam-detailss" action="details" method="POST">
        @csrf
        <div class="form-control">
          <label class="label font-bold">Question:</label>
          <input type="text" class="input input-bordered" name="question" id="question" placeholder="Enter Question" />
        </div>
        <div class="mt-3"></div>
        <div class="form-control">
          <label class="label font-bold">Choices:</label>
          <div class="flex items-baseline gap-3 mt-3">
            <input type="radio" name="choice" value="choice-1" class="radio radio-md radio-success self-center choice choice-1" />
            <input type="text" class="input input-bordered w-full" name="choices[choice-1]" id="choice-1" placeholder="Enter Choice 1" />
          </div>
          <div class="flex items-baseline gap-3 mt-3">
            <input type="radio" name="choice" value="choice-2" class="radio radio-md radio-success self-center choice choice-2" />
            <input type="text" class="input input-bordered w-full" name="choices[choice-2]" id="choice-2" placeholder="Enter Choice 2" />
          </div>
          <div class="flex items-baseline gap-3 mt-3">
            <input type="radio" name="choice" value="choice-3" class="radio radio-md radio-success self-center choice choice-3" />
            <input type="text" class="input input-bordered w-full" name="choices[choice-3]" id="choice-3" placeholder="Enter Choice 3" />
          </div>
          <div class="flex items-baseline gap-3 mt-3">
            <input type="radio" name="choice" value="choice-4" class="radio radio-md radio-success self-center choice choice-4" />
            <input type="text" class="input input-bordered w-full" name="choices[choice-4]" id="choice-4" placeholder="Enter Choice 4" />
          </div>
        </div>
        <div class="mt-3"></div>
        <div class="question-answer-wrapper">
          <label class="label font-bold">Answer:</label>
          <label class="label chosen-answer hidden">Choosen Answer is Pink</label>
        </div>
        <div class="mt-3"></div>
        <button type="submit" class="btn btn-primary">Submit Exam Details</button>
      </form>
    </div>
  </div>
  <div class="card bg-base-100 shadow-xl w-full mt-5">
    <div class="card-body">
      <h2 class="card-title">List of Questions</h2>
      <div class="divider"></div>
      <div class="overflow-x-auto">
        <table class="table table-zebra w-full">
          <thead>
            <tr>
              <th></th>
              <th>Question</th>
              <th>Choices</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if (count($examDetails) > 0)
              @foreach ($examDetails as $examDetail)
                <tr>
                  <td>{{ $examDetail->id }}</td>
                  <td>{{ $examDetail->question }}</td>
                  <td>
                    <div class="choices-wrapper">
                      @foreach ($examDetail->choices as $choice)
                        <div class="description">
                          <span><b>Description:</b> {{ $choice->description }}</span>
                        </div>
                        <div class="answer">
                          <span><b>Is Answer:</b> {{ ($choice->is_answer) ? 'True' : 'False' }}</span>
                        </div>
                        <div class=" mt-4"></div>
                      @endforeach
                    </div>
                  </td>
                  <td>
                    <div class="join">
                      <form action="/exam/{{ $examDetail->exam_id }}/details/{{ $examDetail->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn join-item btn-warning">Delete</button>
                      </form>
                    </div>
                  </td>
                </th>
              @endforeach
            @else
              <tr class="text-center">
                <td colspan="3">No Data is available.</td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
@section('custom-js')
@vite('resources/js/school/exam/index.js')
@endsection
