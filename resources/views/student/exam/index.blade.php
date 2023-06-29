@extends('student.app')
@section('content')
<div class="dashboard-wrapper">
  <div class="card bg-base-100 shadow-xl w-full">
    <div class="card-body">
      <h2 class="card-title">Take Exam</h2>
      <div class="divider"></div>
      <form action="/exam" method="POST">
        @csrf
        <input type="hidden" name="exam_id" value="{{ request()->segment(2) }}" />
        <div class="questions-wrapper">
          @foreach ($exam->examDetails as $key => $examDetail)
            <div class="question-list">
              <div class="form-control">
                <label class="label font-bold">Question #{{ $key += 1 }}:</label>
                <label class="label">{{ $examDetail->question }}</label>
                <input type="hidden" name="question_ids[]" value="{{ $examDetail->id }}" />
              </div>
              <div class="mt-3"></div>
              <div class="form-control">
                <label class="label font-bold">Choices:</label>
                @foreach ($examDetail->choices as $choice)
                  <div class="flex items-baseline gap-3 mt-3">
                    <input type="radio" name="choice_{{ $examDetail->id }}" value="{{ $choice->id }}" class="radio radio-md radio-success self-center choice choice-1" />
                    {{ $choice->description }}
                  </div>
                @endforeach
              </div>
            </div>
            <div class="mt-10"></div>
          @endforeach
        </div>
        <div class="mt-10"></div>
        <button type="submit" class="btn btn-primary">Done Exam</button>
      </form>
    </div>
  </div>
</div>
@endsection
@section('custom-js')
@vite('resources/js/school/exam/index.js')
@endsection
