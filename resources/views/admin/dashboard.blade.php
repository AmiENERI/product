
@extends('layouts.admin')

@section('content')

<body>
<link rel="stylesheet" href= "{{ asset('css/dashboard.css') }}">
<section class="hero-section">
    <div class="container text-center" >
        <div class="pass">
        <form>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">This section is for Administrators only. If you are an administrator then please, logged in.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary border-0">Submit</button>
</form>
</div>
</section>
</body>


@endsection