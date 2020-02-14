@extends('master')
@section('title', 'Carrello')
@section('content')

<div class="row">

<div class="col-md-12">
<div class="card">

    <div class="card-body">

    @if ($esito == 1)
        <h5>Congratulazioni!</h5>
        Hai acquistato i tuoi prodotti con successo!
    @else
        <h5>Mi spiace ma non hai abbastanza soldi per effettuare l'acquisto</h5>
    @endif

    </div>
    <div class="card-footer">
    <a href="product" type="button" class="btn btn-primary">Torna alla pagina dei prodotti</a>
    </div>

    </div>

</div>
</div>
</div>

@endsection
@section('footerScripts')
    @parent
@endsection

