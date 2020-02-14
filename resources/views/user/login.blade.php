@extends('master')
@section('title', 'Carrello')
@section('content')

<div class="row">

@include('partials.head')

<div class="col-md-12">
<div class="card">
<div class="card-header">
Login
</div>
<div class="card-body">

<form action="/login" method="post">
@csrf

  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>
  <button type="submit" class="btn btn-primary">Entra</button>

</form>

</div>
</div>
</div>


</div>

@endsection
@section('footerScripts')
    @parent
@endsection
