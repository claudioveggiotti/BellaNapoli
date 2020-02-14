@extends('master')
@section('title', 'Carrello')
@section('content')

<div class="row">

@include('partials.head')


<div class="col-md-12">

<div class="card">
    <div class="card-header">
    <h5 class="card-title">Prodotti nel carrello</h5>
    </div>
    <div class="card-body">

@forelse ($prodotti as $prodotto)

    <div class="row">
    <div class="col-md-4">
    {{ $prodotto->name }}
    </div>
    <div class="col-md-4">
    € {{ $prodotto->price }} 
    </div>
    </div>
    
@empty
    Non ci sono prodotti nel carrello
@endforelse

    </div>
    
@if (count($prodotti) > 0)
    <div class="card-footer">
     <div class="row">
    <div class="col-md-4">
    <strong>Totale</strong>
    </div>
    <div class="col-md-4">
    € {{ $totale}} 
    </div>
    </div>
    </div>
@endif

    <div class="card-body">

@if (count($prodotti) > 0)
    <a href="/buy" class="btn btn-primary" role="button">ACQUISTA</a>
    <a href="/emptycart" class="btn btn-primary" role="button">Svuota il carrello</a>
@endif
<a href="/product" class="btn btn-primary" role="button">Indietro</a>

    </div>

</div>
</div>
</div>

@endsection
@section('footerScripts')
    @parent
@endsection

