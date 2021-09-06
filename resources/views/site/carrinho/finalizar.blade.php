@extends("layouts.site")

@section('content')

@php

    // SDK do Mercado Pago
    require base_path('/vendor/autoload.php');
    // Adicione as credenciais
    MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));

    // Cria um objeto de preferência
    $preference = new MercadoPago\Preference();

    // Cria um item na preferência
    $item = new MercadoPago\Item();
    $item->title = 'Meu produto';
    $item->quantity = 1;
    $item->unit_price = 75.56;
    $preference->items = array($item);
    $preference->save();
@endphp

<div class="container mt-2 mb-2">

    <!-- ============================ COMPONENT 1 ================================= -->
    <div class="card">
        <div class="card-body">
            @forelse ($pedidos as $pedido)
            <div class="row">
                <div class="col-6 mt-3"><h4> Pedido: {{ $pedido->id }}</h4></div>
                <div class="col-6 mt-3"><h4>Criado em: {{ $pedido->created_at->format('d/m/Y H:i') }}</h4></div>
            </div>
            <div class="row">
                <div class="col-6"><strong>Total dos Produtos</strong></div>
                <div class="col-6">R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}</div>
            </div>
            <div class="row">
                <div class="col-6"><strong>Desconto</strong></div>
                <div class="col-6">R$ {{ number_format($pedido->desconto_pedido, 2, ',', '.') }}</div>
            </div>
            <div class="row">
                <div class="col-6"><strong>Frete</strong></div>
                <div class="col-6">R$ {{ number_format($pedido->frete, 2, ',', '.') }}</div>
            </div>
            @php
                $total_pedido = $pedido->valor_total - $pedido->desconto_pedido + $pedido->frete;
            @endphp
            <div class="row">
                <div class="col-6"><strong>Total do Pedido</strong></div>
                <div class="col-6">R$ {{ number_format($total_pedido, 2, ',', '.') }}</div>
            </div>
            <h5 class="card-title">Como você quer receber ou retirar sua compra?</h5>
            <div class="row">
                <div class="col-9"><h5>Não possui endereço cadastrado</h5></div>
                <div class="col-3">
                    <a class="btn btn-link" href="{{ route('site.carrinho.endereco') }}">Inserir Endereço</a>
                </div>

            </div>
            <div class="row">
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="retira" checked onclick="checkRadio(id,{{ $pedido->id }})" />
                        <label class="form-check-label">Retirar Compra</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="recebe" onclick="checkRadio(id,{{ $pedido->id }})" />
                        <label class="form-check-label">Receber em Casa</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-2 ms-auto">
                    <div class="cho-container"></div>
                </div>
            </div>
            @empty
            <div class="row">
                <h5>Não há nenhum pedido finalizado</h5>
            </div>
            @endforelse
        </div>
    </div> <!-- card.// -->
    <!-- ============================ COMPONENT 1 END .// ================================= -->

</div>

<form id="form-frete" method="POST" action="{{ route('site.carrinho.frete') }}">
    {{ csrf_field() }}
    <input type="hidden" name="id">
    <input type="hidden" name="valorfrete">
</form>

<script src="https://sdk.mercadopago.com/js/v2"></script>

<script>
    // Adicione as credenciais do SDK
    const mp = new MercadoPago("{{ config('services.mercadopago.key') }}", {
        locale: 'pt-BR'
    });

      // Inicialize o checkout
    mp.checkout({
        preference: {
            id: '{{ $preference->id }}'
        },
        render: {
            container: '.cho-container', // Indique o nome da class onde será exibido o botão de pagamento
            label: 'Finalizar Compra', // Muda o texto do botão de pagamento (opcional)
        }
    });

    function checkRadio(id, idpedido) {
        if(id == "retira"){
            console.log("Choice: ", id);
            document.getElementById("retira").checked = true;
            document.getElementById("recebe").checked = false;
            $('#form-frete input[name="id"]').val(idpedido);
            $('#form-frete input[name="valorfrete"]').val(0);
            $('#form-frete').submit();

        } else if (id == "recebe"){
            console.log("Choice: ", id);
            document.getElementById("recebe").checked = true;
            document.getElementById("retira").checked = false;
            $('#form-frete input[name="id"]').val(idpedido);
            $('#form-frete input[name="valorfrete"]').val(1);
            $('#form-frete').submit();
        }
    }

</script>

@endsection
