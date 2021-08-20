@extends("layouts.site")

@section('content')

<div class="container">
    <div class="row">
        <div class="col mt-4"><h2>Minhas compras</h2></div>
        <hr/>
        @if (Session::has('mensagem-sucesso'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('mensagem-sucesso') }}
            </div>
        @endif
        @if (Session::has('mensagem-falha'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('mensagem-falha') }}
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-12"><h3>Compras concluídas</h3></div>
    </div>
        @forelse ($compras as $pedido)
    <div class="row">
            <div class="col-6 mt-3"><h4> Pedido: {{ $pedido->id }}</h4></div>
            <div class="col-6 mt-3"><h4>Criado em: {{ $pedido->created_at->format('d/m/Y H:i') }}</h4></div>
    </div>
    <form method="POST" action="{{ route('site.carrinho.cancelar') }}">
        {{ csrf_field() }}
        <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
    <div class="row">
            <div class="col-2"></div>
            <div class="col-4"></div>
            <div class="col-3">Produto</div>
            <div class="col-1">Valor</div>
            <div class="col-1">Desconto</div>
            <div class="col-1">Total</div>
    </div>
                <hr/>
                @php
                    $total_pedido = 0;
                @endphp
                @foreach ($pedido->pedido_produtos_itens as $pedido_produto)
                    @php
                        $total_produto = $pedido_produto->valor - $pedido_produto->desconto;
                        $total_pedido += $total_produto;
                    @endphp
    <div class="row">
                        <div class="col-2">
                            @if($pedido_produto->status == 'PA')
                                <p>
                                    <input type="checkbox" id="item-{{ $pedido_produto->id }}" name="id[]" value="{{ $pedido_produto->id }}" />
                                    <label for="item-{{ $pedido_produto->id }}">Selecionar</label>
                                </p>
                            @else
                                @php
                                    $total_pedido = $total_pedido - $total_produto;
                                @endphp
                                <strong class="red-text">CANCELADO</strong>
                            @endif
                        </div>
                        <div class="col-4">
                            <img width="200" height="100%" src="../{{ $pedido_produto->produto->imagem }}">
                        </div>
                        <div class="col-3">{{ $pedido_produto->produto->nome }}</div>
                        <div class="col-1">R$ {{ number_format($pedido_produto->valor, 2, ',', '.') }}</div>
                        <div class="col-1">R$ {{ number_format($pedido_produto->desconto, 2, ',', '.') }}</div>
                        <div class="col-1">R$ {{ number_format($total_produto, 2, ',', '.') }}</div>
    </div>
                @endforeach
                <div class="row">
                    <div class="col-6"><strong>Total do pedido</strong></div>
                    <div class="col-6">R$ {{ number_format($total_pedido, 2, ',', '.') }}</div>
                </div>
                <div class="row">
                    <div class="col-3">
                            <button type="submit" class="btn btn-danger" data-tooltip="Cancelar itens selecionados">
                                Cancelar
                            </button>
                    </div>
                </div>
    </form>
        @empty
        <div class="row">
            <div class="col-12">
                <h5>
                    @if ($cancelados->count() > 0)
                        Neste momento não há nenhuma compra valida.
                    @else
                        Você ainda não fez nenhuma compra.
                    @endif
                </h5>
            </div>
        </div>
        @endforelse
    <div class="row">
        <div class="col-12"><h4>Compras canceladas</h4></div>
    </div>
        @forelse ($cancelados as $pedido)
    <div class="row">
            <div class="col-4"><h5> Pedido: {{ $pedido->id }} </h5></div>
            <div class="col-6 mt-3"><h5> Criado em: {{ $pedido->created_at->format('d/m/Y H:i') }} </h5></div>
            <div class="col-6 mt-3"><h5> Cancelado em: {{ $pedido->updated_at->format('d/m/Y H:i') }} </h5></div>
    </div>
    <div class="row">
                <div class="col-6"></div>
                <div class="col-3">Produto</div>
                <div class="col-1">Valor</div>
                <div class="col-1">Desconto</div>
                <div class="col-1">Total</div>
    </div>
                        @php
                            $total_pedido = 0;
                        @endphp
                        @foreach ($pedido->pedido_produtos_itens as $pedido_produto)
                            @php
                                $total_produto = $pedido_produto->valor - $pedido_produto->desconto;
                                $total_pedido += $total_produto;
                            @endphp
    <div class="row">
                    <div class="col-6">
                        <img width="250" height="100%" src="../{{ $pedido_produto->produto->imagem }}">
                    </div>
                    <div class="col-3">{{ $pedido_produto->produto->nome }}</div>
                    <div class="col-1">R$ {{ number_format($pedido_produto->valor, 2, ',', '.') }}</div>
                    <div class="col-1">R$ {{ number_format($pedido_produto->desconto, 2, ',', '.') }}</div>
                    <div class="col-1">R$ {{ number_format($total_produto, 2, ',', '.') }}</div>
    </div>
                        @endforeach
                <div class="row">
                    <div class="col-6"><strong>Total do pedido</strong></div>
                    <div class="col-6">R$ {{ number_format($total_pedido, 2, ',', '.') }}</div>
                </div>
        @empty
        <div class="row">
            <div class="col-12">
                <h5>Nenhuma compra ainda foi cancelada.</h5>
            </div>
        </div>
        @endforelse
    </div>

</div>

@endsection
