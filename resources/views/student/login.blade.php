<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite([
      'resources/css/app.css',
      'resources/js/app.js'
    ])
  </head>
  <body>
    <div class="container mx-auto">
      <div class="flex h-screen justify-center">
        <div class="card bg-base-100 w-1/3 shadow-xl self-center">
          <div class="card-body">
            <h2 class="flex justify-center gap-2 text-2xl">
              <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                </svg>
              </div>
              Login as Student
            </h2>
            <div class="divider"></div>
            <div class="form-control">
              <label class="input-group">
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" d="M16.5 12a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zm0 0c0 1.657 1.007 3 2.25 3S21 13.657 21 12a9 9 0 10-2.636 6.364M16.5 12V8.25" />
                  </svg>
                </span>
                <input type="text" placeholder="info@site.com" class="input input-bordered w-full h-14" />
              </label>
            </div>
            <div class="form-control mt-2">
              <label class="input-group">
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                  </svg>
                </span>
                <input type="password" placeholder="Password" class="input input-bordered w-full h-14" />
              </label>
            </div>
            <div class="mt-2">
              <a href="/dashboard" class="btn btn-primary w-full">Login</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
