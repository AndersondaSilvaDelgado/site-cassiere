@extends("layouts.site")

@section('content')

<div class="container mt-2 mb-2">

    <form method="get" action=".">

        <!-- ============================ COMPONENT 1 ================================= -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Endereço para Entrega</h5>
                <div class="row">
                    <div class="form-group">
                        <label for="nome">Nome Completo</label>
                        <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome Completo" value="{{ $endereco->nome ?? old('nome') }}"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="cep">CEP</label>
                            <input type="text" class="form-control" name="cep" id="cep" placeholder="CEP" value="{{ $endereco->cep ?? old('cep') }}"
                            size="10" maxlength="9" onblur="pesquisacep(this.value);" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="uf">Estado</label>
                            <input type="text" class="form-control" name="uf" id="uf" placeholder="Estado" value="{{ $endereco->uf ?? old('uf') }}" />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="cidade">Cidade</label>
                            <input type="text" class="form-control" name="cidade" id="cidade" placeholder="Cidade" value="{{ $endereco->cidade ?? old('cidade') }}" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="bairro">Bairro</label>
                        <input type="text" class="form-control" name="bairro" id="bairro" placeholder="Bairro" value="{{ $endereco->bairro ?? old('bairro') }}" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-9">
                        <div class="form-group">
                            <label for="rua">Rua/Avenida</label>
                            <input type="text" class="form-control" name="rua" id="rua" placeholder="Rua/Avenida" value="{{ $endereco->rua ?? old('rua') }}" />
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="numero">Número</label>
                            <input type="numeric" class="form-control" name="numero" id="numero" placeholder="Número" value="{{ $endereco->numero ?? old('numero') }}" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="ativo" value="S" checked>
                            <label class="form-check-label">Casa</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="ativo" value="N">
                            <label class="form-check-label">Trabalho</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="telefone">Telefone de Contato</label>
                            <input type="text" class="form-control" name="telefone" id="telefone" placeholder="Telefone de Contato" value="{{ $endereco->telefone ?? old('telefone') }}" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="detalhes">Indicações adicionais para entregar suas compras neste endereço. (opcional)</label>
                        <textarea type="text" class="form-control" name="bairro" id="bairro">{{ $endereco->detalhe ?? old('detalhe') }}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <button type="button" class="btn btn-link">Retorna ao Pedidos</button>
                    </div>
                    <div class="col-2 ms-auto">
                        <button type="button" class="btn btn-success">Finalizar Cadastro</button>
                    </div>
                </div>
            </div>
        </div> <!-- card.// -->
        <!-- ============================ COMPONENT 1 END .// ================================= -->

    </form>

</div>

@endsection
