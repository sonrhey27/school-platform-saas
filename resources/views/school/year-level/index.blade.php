@extends('school.app')
@section('content')
<div class="dashboard-wrapper">
  <div class="card bg-base-100 shadow-xl w-96">
    <div class="card-body">
      <h2 class="card-title">Create a Year / Grade</h2>
      <div class="divider"></div>
      <form action="year-level" method="POST">
        @csrf
        <div class="form-control w-full max-w-xs">
          <label class="label">
            <span class="label-text">Year / Grade</span>
          </label>
          <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" name="name" />
        </div>
        <div class="form-control w-full max-w-xs">
          <label class="label">
            <span class="label-text">Adviser</span>
          </label>
          <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" name="adviser" />
        </div>
        <div class="mt-4">
          <button type="submit" class="btn btn-outline w-full">Submit</button>
        </div>
      </form>
    </div>
  </div>
  <div class="card bg-base-100 shadow-xl w-full mt-5">
    <div class="card-body">
      <h2 class="card-title">List of year level</h2>
      <div class="divider"></div>
      <div class="overflow-x-auto">
        <table class="table table-zebra w-full">
          <thead>
            <tr>
              <th></th>
              <th>Year level</th>
              <th>Adviser</th>
            </tr>
          </thead>
          <tbody>
            @if (count($yearLevels) > 0)
              @foreach ($yearLevels as $yearLevel)
                <tr>
                  <td>{{ $yearLevel->id }}</td>
                  <td>{{ $yearLevel->name }}</td>
                  <td>{{ $yearLevel->adviser }}</td>
                </tr>
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
