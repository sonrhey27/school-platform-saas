@if ($errors->any())
  <div class="toast toast-top" id="message">
    <div class="alert alert-warning">
      <ul class="block">
        @foreach ($errors->all() as $error)
          <li class=" font-bold">{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  </div>
@endif
