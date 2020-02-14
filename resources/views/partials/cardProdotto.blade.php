<div class="col-md-4 col-sm-6">
<div class="card bg-light mb-3">
  <div class="card-body">
    <h5 class="card-title">{{ $name }}</h5>
    <p class="card-text" style="height: 50px">{{ $descr }}</p>
  </div>
  <div class="card-body">
    <div class="row">
    <div class="col-md-6">
    Costo: {{ $price }} euro
    </div>
    <div class="col-md-6" align="righ">
    Quantità: {{ $stock }}
    </div>
    </div>
    @if ($merchant == '1')
      <a href="/product/{{ $id }}/edit" class="card-link">Modifica</a>
    @endif
    @if ($merchant == '0' && $user != 'guest')
      <a href="/addtocart/{{ $id }}" class="card-link">Acquista</a>
    @endif
  </div>
</div>
</div>

