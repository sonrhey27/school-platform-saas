@if (session('status'))
  <div class="toast toast-top" id="message">
    <div class="alert alert-success">
      <span>{{ session('status') }}</span>
    </div>
  </div>
@endif
