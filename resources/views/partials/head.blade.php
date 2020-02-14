<div class="col-md-12">
<div class="card bg-light mb-3">
    <div class="card-body">

    <div class="row">

    <div class="col-md-8">
    <span><strong>{{$user}}</strong></span>
    @if ($user != 'guest' && $merchant == 0)
         | saldo: € {{$balance}}
    @endif
    @if ($merchant == 1)
         | <a href="/product/create" class="card-link">Aggiungi un prodotto</a>
    @endif
    </div>

    <div class="col-md-4" align="right">
    @if ($user != "guest")
        <a href="logout" class="card-link">logout</a>
    @else
        <a href="login" class="card-link">login</a>
        <a href="signup" class="card-link">registrati</a>
    @endif
    @if ($merchant != 1 && $user != "guest")
        <a href="/checkout" class="card-link">Carrello</a>
    @endif
    </div>

    </div>
    </div>
</div>
</div>


