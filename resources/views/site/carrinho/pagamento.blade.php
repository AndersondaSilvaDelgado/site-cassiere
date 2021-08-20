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

<div class="cho-container">
</div>

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
                label: 'Pagar', // Muda o texto do botão de pagamento (opcional)
          }
    });
</script>

@endsection
