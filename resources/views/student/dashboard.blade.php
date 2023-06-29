@extends('student.app')
@section('content')
<div class="dashboard-wrapper">
  <div class="card bg-base-100 shadow-xl w-full mt-5">
    <div class="card-body">
      <h2 class="card-title">List of Exams</h2>
      <div class="divider"></div>
      <div class="overflow-x-auto">
        <table class="table table-zebra w-full">
          <thead>
            <tr>
              <th>Subject</th>
              <th>Exam Title</th>
              <th>Exam Score</th>
              <th>Exam Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if (count($exams) > 0)
              @foreach ($exams as $exam)
                <tr>
                  <td>{{ $exam->subject->name }}</td>
                  <td>{{ $exam->title }}</td>
                  <td>
                    <div class="badge badge-outline">
                      @if ($exam->examTaken()->findMyExams()->count() > 0)
                        {{ $exam->examTaken()->findMyExams()->first()->score }}
                      @else
                        Not yet Started
                      @endif
                    </div>
                  </td>
                  <td>
                    @if ($exam->examTaken()->findMyExams()->count() > 0)
                      @if ($exam->examTaken()->findMyExams()->first()->remarks === 'Fail')
                        <div class="badge badge-secondary badge-outline">
                          {{ $exam->examTaken()->findMyExams()->first()->remarks }}
                        </div>
                      @else
                        <div class="badge badge-success badge-outline">
                          {{ $exam->examTaken()->findMyExams()->first()->remarks }}
                        </div>
                      @endif
                    @else
                      <div class="badge badge-outline">
                        Not yet Started
                      </div>
                    @endif
                  </td>
                  <td>
                    @if ($exam->examTaken()->findMyExams()->count() > 0)
                      <label class="label">Already Taked.</label>
                    @else
                      <a href="/exam/{{ $exam->id }}" class="btn btn-primary">Take Exam</a>
                    @endif
                  </td>
                </tr>
              @endforeach
            @else
              <tr class="text-center">
                <td colspan="5">No Data is available.</td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
