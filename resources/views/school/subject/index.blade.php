@extends('school.app')
@section('content')
<div class="dashboard-wrapper">
  <div class="card bg-base-100 shadow-xl w-96">
    <div class="card-body">
      <h2 class="card-title">Create a Subject</h2>
      <div class="divider"></div>
      <form action="subject" method="POST" id="subject">
        @csrf
        <div class="form-control w-full max-w-xs">
          <label class="label">
            <span class="label-text">Subject Name</span>
          </label>
          <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" name="name" />
        </div>
        <div class="form-control w-full max-w-xs">
          <label class="label">
            <span class="label-text">Grade / Year</span>
          </label>
          <select class="select select-bordered" name="year_level_id">
            <option disabled selected>Pick one</option>
            @foreach ($yearLevels as $yearLevel)
              <option value="{{ $yearLevel->id }}">{{ $yearLevel->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="mt-4">
          <button type="submit" class="btn btn-outline w-full">Submit</button>
        </div>
      </form>
    </div>
  </div>
  <div class="card bg-base-100 shadow-xl w-full mt-5">
    <div class="card-body">
      <h2 class="card-title">List of Subjects</h2>
      <div class="divider"></div>
      <div class="overflow-x-auto">
        <table class="table table-zebra w-full">
          <thead>
            <tr>
              <th></th>
              <th>Subject Name</th>
              <th>Year Level</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if (count($subjects) > 0)
              @foreach ($subjects as $subject)
                <tr>
                  <td>{{ $subject->id }}</td>
                  <td>{{ $subject->name }}</td>
                  <td>{{ $subject->yearLevel->name }}</td>
                  <td>
                    <div class="join">
                      <form action="/subject/{{ $subject->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn join-item btn-primary" id="btn-edit">Edit</button>
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
@vite('resources/js/school/subject/index.js')
@endsection
