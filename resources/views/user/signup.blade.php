@extends('master')
@section('title', 'Carrello')
@section('content')

<div class="row">

@include('partials.head')

<div class="col-md-12">
<div class="card">
<div class="card-header">
Registrazione Cliente
</div>
<div class="card-body">

<form action="/signup" method="post">
@csrf

  <div class="form-group">
    <label>Nome</label>
    <input type="text" name="name" class="form-control" id="exampleInputEmail1">
  </div>
  <div class="form-group">
    <label>Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1">
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" name="password" class="form-control">
  </div>
  <div class="form-group">
  <label>Registrati come:</label>
  <select name="merchant" class="form-control" 
  @if ($merchantExist == 1)
    disabled
  @endif
  >
    <option value="0">Cliente</option>
    <option value="1">Merchant</option>
  </select>
  </div>
  <button type="submit" class="btn btn-primary">Invia</button>

</form>

</div>
</div>
</div>


</div>

@endsection
@section('footerScripts')
    @parent
@endsection
