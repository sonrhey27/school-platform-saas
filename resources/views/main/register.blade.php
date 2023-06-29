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
        <div class="card bg-base-100 w-96 shadow-xl self-center">
          <div class="card-body">
            <h2 class="flex justify-center gap-2 text-2xl">
              <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                </svg>
              </div>
              Register as School
            </h2>
            <div class="divider"></div>
            <form action="/schools" method="POST">
              @csrf
              <div class="form-control">
                <label class="label">
                  <span class="label-text">School Name</span>
                </label>
                <input type="text" placeholder="Type here" class="input input-bordered w-full" name="name" />
              </div>
              <div class="form-control mt-2">
                <label class="label">
                  <span class="label-text">School Email</span>
                </label>
                <input type="email" placeholder="Type here" class="input input-bordered w-full" name="email" />
              </div>
              <div class="form-control mt-2">
                <label class="label">
                  <span class="label-text">School Password</span>
                </label>
                <input type="password" placeholder="Type here" class="input input-bordered w-full" name="password" />
              </div>
              <div class="mt-2">
                <button type="submit" class="btn btn-outline w-full">Register</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
