@extends('school.app')
@section('content')
<div class="dashboard-wrapper">
  <div class="card bg-base-100 shadow-xl w-96">
    <div class="card-body">
      <h2 class="card-title">Create an Exam</h2>
      <div class="divider"></div>
      <form action="/exam" method="POST">
        @csrf
        <div class="form-control w-full max-w-xs">
          <label class="label">
            <span class="label-text">Grade / Year</span>
          </label>
          <select class="select select-bordered" name="year_level" id="year_level">
            <option disabled selected>Pick one</option>
            @foreach ($yearLevels as $yearLevel)
              <option value="{{ $yearLevel->id }}">{{ $yearLevel->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-control w-full max-w-xs">
          <label class="label">
            <span class="label-text">Subject List</span>
          </label>
          <select class="select select-bordered" name="subject_list" id="subject_list">
          </select>
        </div>
        <div class="form-control w-full max-w-xs">
          <label class="label">
            <span class="label-text">Title</span>
          </label>
          <input type="text" class="input input-bordered choice-1 w-full" id="title" name="title" disabled />
        </div>
        <div class="mt-4">
          <button type="submit" class="btn btn-outline w-full">Submit</button>
        </div>
      </form>
    </div>
  </div>
  <div class="card bg-base-100 shadow-xl w-full mt-5">
    <div class="card-body">
      <h2 class="card-title">List of Exams</h2>
      <div class="divider"></div>
      <div class="overflow-x-auto">
        <table class="table table-zebra w-full">
          <thead>
            <tr>
              <th></th>
              <th>Title</th>
              <th>Subject Name</th>
              <th>Year Level</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if (count($exams) > 0)
              @foreach ($exams as $exam)
                <tr>
                  <td>{{ $exam->id }}</td>
                  <td>{{ $exam->title }}</td>
                  <td>{{ $exam->subject->name }}</td>
                  <td>{{ $exam->yearLevel->name }}</td>
                  <td>
                    <div class="join">
                      <form action="/exam/{{ $exam->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="/exam/{{ $exam->id }}/details" class="btn btn-secondary">Add Questions</a>
                        <button type="submit" class="btn join-item btn-warning">Delete</button>
                      </form>
                    </div>
                  </td>
                </tr>
              @endforeach
            @else
              <tr class="text-center">
                <td colspan="4">No Data is available.</td>
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
