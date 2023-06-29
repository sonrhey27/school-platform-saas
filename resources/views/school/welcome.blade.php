@extends('school.app')
@section('content')
  <div class="dashboard-wrapper grid grid-cols-1 gap-4 md:grid-cols-3">
    <div class="card bg-base-100 shadow-xl">
      <div class="card-body">
        <h2 class="card-title">Students Registered</h2>
        <div class="divider"></div>
        <h4 class="text-6xl">{{ $studentRegisterCount }}</h4>
      </div>
    </div>
    <div class="card bg-base-100 shadow-xl">
      <div class="card-body">
        <h2 class="card-title">Exams Created</h2>
        <div class="divider"></div>
        <h4 class="text-6xl">{{ $examCount }}</h4>
      </div>
    </div>
    <div class="card bg-base-100 shadow-xl">
      <div class="card-body">
        <h2 class="card-title">Subjects Created</h2>
        <div class="divider"></div>
        <h4 class="text-6xl">{{ $subjectCount }}</h4>
      </div>
    </div>
  </div>
  <div class="mt-11"></div>
  <div class="table-wrapper">
    <h1 class="text-3xl mb-4">Top 5 new Students</h1>
    <div class="overflow-x-auto">
      <table class="table table-zebra w-full">
        <!-- head -->
        <thead>
          <tr>
            <th></th>
            <th>Name</th>
            <th>Initial</th>
            <th>Student Domain</th>
          </tr>
        </thead>
        <tbody>
          @if (count($students) > 0)
            @foreach ($students as $student)
              <tr>
                <th>{{ $student->id }}</th>
                <td>{{ $student->name }}</td>
                <td>{{ $student->initial }}</td>
                <td>{{ $student->tenant->name }}</td>
              </tr>
            @endforeach
          @else
              <tr class="text-center">
                <td colspan="4">No Data available.</td>
              </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>
@endsection
