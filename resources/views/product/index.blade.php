@extends('master')
@section('title', 'I nostri Prodotti')
@section('content')

<div class="row">

@include('partials.head')

@forelse ($prodotti as $prodotto)

    @include('partials.cardProdotto', [
        'id' => $prodotto->id,
        'name' => $prodotto->name,
        'descr' => $prodotto->descr,
        'price' => $prodotto->price,
        'stock' => $prodotto->stock
    ])

@empty

    Non ci sono prodotti disponibili

@endforelse

</div>

@endsection
@section('footerScripts')
    @parent
@endsection

