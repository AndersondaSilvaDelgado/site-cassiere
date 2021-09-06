<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\RPedidoProduto;
use Illuminate\Support\Facades\Auth;

class CarrinhoController extends Controller
{

    function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $pedidos = Pedido::where([
            'status'  => 'RE',
            'user_id' => Auth::id()
            ])->get();

        return view('site.carrinho.index', compact('pedidos'));

    }

    public function adicionar(Request $request)
    {

        $this->middleware('VerifyCsrfToken');

        $idproduto = $request->input('id');

        $produto = Produto::find($idproduto);
        if( empty($produto->id) ) {
            $request->session()->flash('mensagem-falha', 'Produto não encontrado em nossa loja!');
            return redirect()->route('site.carrinho.index');
        }

        $idusuario = Auth::id();

        $idpedido = Pedido::consultaId([
            'user_id' => $idusuario,
            'status'  => 'RE' // Reservada
            ]);

        if( empty($idpedido) ) {
            $pedido_novo = Pedido::create([
                'user_id' => $idusuario,
                'status'  => 'RE'
                ]);

            $idpedido = $pedido_novo->id;

        }

        RPedidoProduto::create([
            'pedido_id'  => $idpedido,
            'produto_id' => $idproduto,
            'valor'      => $produto->valor,
            'status'     => 'RE'
            ]);

        RPedidoProduto::where([
                'status'    => 'FI'
            ])->update([
                'status' => 'CA'
            ]);

        Pedido::where([
                'status'    => 'FI'
            ])->update([
                'status' => 'CA'
            ]);

        $request->session()->flash('mensagem-sucesso', 'Produto adicionado ao carrinho com sucesso!');

        return redirect()->route('site.carrinho.index');

    }


    public function remover()
    {

        $this->middleware('VerifyCsrfToken');

        $req = Request();
        $idpedido           = $req->input('pedido_id');
        $idproduto          = $req->input('produto_id');
        $remove_apenas_item = (boolean)$req->input('item');
        $idusuario          = Auth::id();

        $idpedido = Pedido::consultaId([
            'id'      => $idpedido,
            'user_id' => $idusuario,
            'status'  => 'RE' // Reservada
            ]);

        if( empty($idpedido) ) {
            $req->session()->flash('mensagem-falha', 'Pedido não encontrado!');
            return redirect()->route('site.carrinho.index');
        }

        $where_produto = [
            'pedido_id'  => $idpedido,
            'produto_id' => $idproduto
        ];

        $produto = RPedidoProduto::where($where_produto)->orderBy('id', 'desc')->first();
        if( empty($produto->id) ) {
            $req->session()->flash('mensagem-falha', 'Produto não encontrado no carrinho!');
            return redirect()->route('site.carrinho.index');
        }

        if( $remove_apenas_item ) {
            $where_produto['id'] = $produto->id;
        }
        RPedidoProduto::where($where_produto)->delete();

        $check_pedido = RPedidoProduto::where([
            'pedido_id' => $produto->pedido_id
            ])->exists();

        if( !$check_pedido ) {
            Pedido::where([
                'id' => $produto->pedido_id
                ])->delete();
        }

        $req->session()->flash('mensagem-sucesso', 'Produto removido do carrinho com sucesso!');

        return redirect()->route('site.carrinho.index');
    }


    public function concluir()
    {

        $this->middleware('VerifyCsrfToken');

        $req = Request();
        $idpedido  = $req->input('pedido_id');
        $idusuario = Auth::id();

        $check_pedido = Pedido::where([
            'id'      => $idpedido,
            'user_id' => $idusuario,
            'status'  => 'RE' // Reservada
            ])->exists();

        if( !$check_pedido ) {
            $req->session()->flash('mensagem-falha', 'Pedido não encontrado!');
            return redirect()->route('site.carrinho.index');
        }

        $check_produtos = RPedidoProduto::where([
            'pedido_id' => $idpedido
            ])->exists();
        if(!$check_produtos) {
            $req->session()->flash('mensagem-falha', 'Produtos do pedido não encontrados!');
            return redirect()->route('site.carrinho.index');
        }

        $r_pedido_produtos = RPedidoProduto::where([
            'pedido_id' => $idpedido
            ])->get();

        $total_pedido = 0;

        foreach ($r_pedido_produtos as $pedido_produto){
            $total_produto = $pedido_produto->valor - $pedido_produto->desconto;
            $total_pedido += $total_produto;
        }

        RPedidoProduto::where([
            'pedido_id' => $idpedido
            ])->update([
                'status' => 'FI'
            ]);

        Pedido::where([
                'id' => $idpedido
            ])->update([
                'status' => 'FI',
                'valor_total' => $total_pedido
            ]);

        return redirect()->route('site.carrinho.finalizar');

    }

    public function compras()
    {

        $compras = Pedido::where([
            'status'  => 'PA',
            'user_id' => Auth::id()
            ])->orderBy('created_at', 'desc')->get();

        $cancelados = Pedido::where([
            'status'  => 'CA',
            'user_id' => Auth::id()
            ])->orderBy('updated_at', 'desc')->get();

        return view('site.carrinho.compras', compact('compras', 'cancelados'));

    }

    public function cancelar()
    {

        $this->middleware('VerifyCsrfToken');

        $req = Request();
        $idpedido       = $req->input('pedido_id');
        $idspedido_prod = $req->input('id');
        $idusuario      = Auth::id();

        if( empty($idspedido_prod) ) {
            $req->session()->flash('mensagem-falha', 'Nenhum item selecionado para cancelamento!');
            return redirect()->route('site.carrinho.compras');
        }

        $check_pedido = Pedido::where([
            'id'      => $idpedido,
            'user_id' => $idusuario,
            'status'  => 'PA' // Pago
            ])->exists();

        if( !$check_pedido ) {
            $req->session()->flash('mensagem-falha', 'Pedido não encontrado para cancelamento!');
            return redirect()->route('site.carrinho.compras');
        }

        $check_produtos = RPedidoProduto::where([
                'pedido_id' => $idpedido,
                'status'    => 'PA'
            ])->whereIn('id', $idspedido_prod)->exists();

        if( !$check_produtos ) {
            $req->session()->flash('mensagem-falha', 'Produtos do pedido não encontrados!');
            return redirect()->route('site.carrinho.compras');
        }

        RPedidoProduto::where([
                'pedido_id' => $idpedido,
                'status'    => 'PA'
            ])->whereIn('id', $idspedido_prod)->update([
                'status' => 'CA'
            ]);

        $check_pedido_cancel = RPedidoProduto::where([
                'pedido_id' => $idpedido,
                'status'    => 'PA'
            ])->exists();

        if( !$check_pedido_cancel ) {

            Pedido::where([
                'id' => $idpedido
            ])->update([
                'status' => 'CA'
            ]);

            $req->session()->flash('mensagem-sucesso', 'Compra cancelada com sucesso!');

        } else {
            $req->session()->flash('mensagem-sucesso', 'Item(ns) da compra cancelado(s) com sucesso!');
        }

        return redirect()->route('site.carrinho.compras');

    }

    public function endereco(){
        return view('site.carrinho.endereco');
    }

    public function finalizar(){

        $pedidos = Pedido::where([
            'status'  => 'FI',
            'user_id' => Auth::id()
            ])->get();

        return view('site.carrinho.finalizar', compact('pedidos'));
    }

    public function frete(Request $request)
    {

        $url = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=08082650&sDsSenha=564321&sCepOrigem=70002900&sCepDestino=04547000&nVlPeso=1&nCdFormato=1&nVlComprimento=20&nVlAltura=20&nVlLargura=20&sCdMaoPropria=n&nVlValorDeclarado=0&sCdAvisoRecebimento=n&nCdServico=04510&nVlDiametro=0&StrRetorno=xml&nIndicaCalculo=3";

        $unparsedResult = file_get_contents($url);
        $parsedResult = simplexml_load_string($unparsedResult);

        Pedido::where([
            'id' => $request->id
        ])->update([
            'frete' => str_replace(",",".", strval($parsedResult->cServico->Valor))
        ]);

        return redirect()->route('site.carrinho.finalizar');

    }

}
