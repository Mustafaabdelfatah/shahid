@if(session()->has('success'))
<div class="alert alert-success col-6" role="alert">
    {{ session('success') }}
  </div>
@endif
@if(session()->has('error'))
<div class="alert  alert-danger col-6" role="alert">
    {{ session('error') }}
  </div>
@endif


