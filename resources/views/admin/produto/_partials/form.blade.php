@csrf
<div class="card-body">
    <div class="form-group">
        <label for="nome">Nome do Produto</label>
        <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome do Produto" value="{{ $produto->nome ?? old('nome') }}">
    </div>
    <div class="form-group">
        <label for="descricao">Descrição do Produto </label>
        <textarea class="form-control" rows="3" name="descricao" id="descricao" placeholder="Descrição do Produto">{{ $produto->descricao ?? old('descricao') }}</textarea>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="valor">Preço do Produto</label>
                <input type="numeric" class="form-control" name="valor" id="valor" placeholder="Preço do Produto" value="{{ $produto->valor ?? old('valor') }}">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="qtde">Qtde do Produto</label>
                <input type="numeric" class="form-control" name="qtde" id="qtde" placeholder="Qtde do Produto" value="{{ $produto->qtde ?? old('qtde') }}">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="imagem">Foto</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="imagem" id="imagem">
                <label class="custom-file-label" for="imagem">Selecionar Imagem</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="ativo" value="S" checked>
            <label class="form-check-label">Ativo</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="ativo" value="N">
            <label class="form-check-label">Inativo</label>
        </div>
    </div>
</div>
<!-- /.card-body -->
<div class="card-footer">
    <a href="#" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-primary float-right">Salvar</button>
</div>
