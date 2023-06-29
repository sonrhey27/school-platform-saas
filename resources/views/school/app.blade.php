<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite([
      'resources/css/app.css',
      'resources/js/app.js',
    ])
  </head>
  <body>
    <div class="navbar bg-base-100 shadow-xl h-20">
      <div class="navbar-start">
        <div class="dropdown">
          <label tabindex="0" class="btn btn-ghost btn-circle">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>
          </label>
          <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
            <li><a href="/dashboard">Home</a></li>
            <li><a href="/subject">Subjects</a></li>
            <li><a href="/exam">Exams</a></li>
            <li><a href="/year-level">School Year</a></li>
            <li><a href="/">Logout</a></li>
          </ul>
        </div>
      </div>
      <div class="navbar-end">
        <a class="btn btn-ghost normal-case text-xl">{{ app('currentTenant')->name   }}</a>
      </div>
    </div>
    <div class="container mx-auto mt-10 w-96 sm:w-full">
      @yield('content')
    </div>
  @include('school.alerts.success')
  @include('school.alerts.error')
  @vite('resources/js/school/index.js')
  @yield('custom-js')
  </body>
</html>
