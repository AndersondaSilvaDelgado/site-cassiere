@extends("layouts.site")

@section('content')

    <div class="container mt-2 mb-2">

        <!-- ============================ COMPONENT 1 ================================= -->
        <div class="card">
            <div class="row  row-cols-md-2">
                <div class="co col-produto md-6 border-right">
                    <img src="{{ asset($produto->imagem) }}">
                </div>
                <main class="col md-6 border-left">
                    <article class="content-body">

                    <h2 class="title">{{ $produto->nome }}</h2>

                    <div class="mb-3">
                        <var class="price h4">R$ {{ $produto->valor }}</var>
                    </div>

                    <p>{{ $produto->descricao }}</p>

                    <hr>
                        <div class="row">
                            <div class="form-group col">
                                <div class="mt-2">
                                    <form method="POST" action="{{ route('site.carrinho.adicionar') }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{ $produto->id }}">
                                        <button class="btn
                                        @if (Auth::guest())
                                        disabled
                                        @endif
                                        btn-outline-danger" data-tooltip="O produto será adicionado ao seu carrinho">Adicionar ao Carrinho</button>
                                    </form>
                                </div>
                            </div> <!-- col.// -->
                        </div> <!-- row.// -->

                    </article> <!-- product-info-aside .// -->
                </main> <!-- col.// -->
            </div> <!-- row.// -->
        </div> <!-- card.// -->
        <!-- ============================ COMPONENT 1 END .// ================================= -->

    </div>

@endsection
