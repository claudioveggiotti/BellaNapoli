@extends('master')
@section('title', 'I nostri Prodotti')
@section('content')
<div class="row">
<div class="col-md-7">


<div class="card">
<div class="card-body">

<form action="/product/{{$id}}" method="POST">
    @method('PUT')
    @csrf
    <div class="form-group">
    <div class="form-group">
        <label>Nome Prodotto</label>
        <input type="text" class="form-control" id="input-productName" name="productName" value="{{$name}}">
    </div>
    <div class="form-group">
        <label>Descrizione</label>
        <input type="text" class="form-control" id="input-productDescr" name="productDescr" value="{{$descr}}">
        <small id="emailHelp" class="form-text text-muted">nel caso di una pizza indicare gli ingredienti</small>
    </div>
    <div class="row">
    <div class="col-md-6">
    <div class="form-group">
        <label>Prezzo</label>
        <input type="text" class="form-control" id="input-productPrice" name="productPrice" value="{{$price}}">
    </div>
    </div>
    <div class="col-md-6">
    <div class="form-group">
        <label>Quantità</label>
        <input type="text" class="form-control" id="input-productStock" name="productStock" value="{{$stock}}">
    </div>
    </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="/product" class="btn btn-primary" role="button">Annulla</a>

</form>

@if ($errors->any()) 
    <ul id="errors"> 
       @foreach ($errors->all() as $error) 
           <li>{{ $error }}</li> 
       @endforeach 
    </ul> 
@endif

    
</div>
</div>


</div>
</div>
@endsection
@section('footerScripts')
    @parent
@endsection

