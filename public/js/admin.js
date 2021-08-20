function excluirProduto( idproduto ) {
    $('#form-excluir-produto input[name="id"]').val(idproduto);
    $('#form-excluir-produto').submit();
}
