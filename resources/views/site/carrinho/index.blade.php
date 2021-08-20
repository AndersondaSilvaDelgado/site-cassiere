@extends("layouts.site")

@section('content')

<div class="container">
    <div class="row">
        <h3 class="mt-4">Produtos no carrinho</h3>
        <hr/>
        @if (Session::has('mensagem-sucesso'))
            <div class="alert alert-success" role="alert">
                <strong>{{ Session::get('mensagem-sucesso') }}</strong>
            </div>
        @endif
        @if (Session::has('mensagem-falha'))
            <div class="alert alert-danger" role="alert">
                <strong>{{ Session::get('mensagem-falha') }}</strong>
            </div>
        @endif
        @forelse ($pedidos as $pedido)
            <h5 class="col l6 s12 m6"> Pedido: {{ $pedido->id }} </h5>
            <h5 class="col l6 s12 m6"> Criado em: {{ $pedido->created_at->format('d/m/Y H:i') }} </h5>
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Qtd</th>
                        <th>Produto</th>
                        <th>Valor Unit.</th>
                        <th>Desconto(s)</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_pedido = 0;
                    @endphp
                    @foreach ($pedido->pedido_produtos as $pedido_produto)
                    <tr>
                        <td>
                            <img width="100" height="100" src="{{ $pedido_produto->produto->imagem }}">
                        </td>
                        <td class="center-align">
                            <div class="form-group col-md flex-grow-0">
                                <div class="input-group mb-1 mt-3 input-spinner">
                                    <a class="btn btn-secondary" type="button" id="button-plus" href="#" href="#" onclick="carrinhoAdicionarProduto({{ $pedido_produto->produto_id }})"> + </a>
                                    <input type="text" class="text-center" value="{{ $pedido_produto->qtd }}">
                                    <a class="btn btn-secondary" type="button" id="button-minus" href="#" onclick="carrinhoRemoverProduto({{ $pedido->id }}, {{ $pedido_produto->produto_id }}, 1 )"> - </a>
                                </div>
                            </div>
                            <a href="#" onclick="carrinhoRemoverProduto({{ $pedido->id }}, {{ $pedido_produto->produto_id }}, 0)" data-tooltip="Retirar produto do carrinho?">Retirar produto</a>
                        </td>
                        <td> {{ $pedido_produto->produto->nome }} </td>
                        <td>R$ {{ number_format($pedido_produto->produto->valor, 2, ',', '.') }}</td>
                        <td>R$ {{ number_format($pedido_produto->descontos, 2, ',', '.') }}</td>
                        @php
                            $total_produto = $pedido_produto->valores - $pedido_produto->descontos;
                            $total_pedido += $total_produto;
                        @endphp
                        <td>R$ {{ number_format($total_produto, 2, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <strong class="col-6">Total do pedido: </strong>
                <span class="col-6">R$ {{ number_format($total_pedido, 2, ',', '.') }}</span>
            </div>
            <div class="row justify-content-between">
                <div class="col-3">
                    <a class="btn btn-link" href="#">Continuar comprando</a>
                </div>
                <div class="col-3">
                    <form method="POST" action="{{ route('site.carrinho.concluir') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
                        <button type="submit" class="btn btn-success" >
                            Concluir compra
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <h5>Não há nenhum pedido no carrinho</h5>
        @endforelse
    </div>
</div>

<form id="form-adicionar-produto" method="POST" action="{{ route('site.carrinho.adicionar') }}">
    {{ csrf_field() }}
    <input type="hidden" name="id">
</form>
<form id="form-remover-produto" method="POST" action="{{ route('site.carrinho.remover') }}">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <input type="hidden" name="pedido_id">
    <input type="hidden" name="produto_id">
    <input type="hidden" name="item">
</form>

@endsection
