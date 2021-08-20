<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $produtos = Produto::where([
            'ativo' => 'S'
            ])->get();

        return view('site.index', compact('produtos'));

    }

    public function produto($id = null)
    {
        if( !empty($id) ) {
            $produto = Produto::where([
                'id'    => $id,
                'ativo' => 'S'
                ])->first();

            if( !empty($produto) ) {
                return view('site.produto', compact('produto'));
            }
        }
        return redirect()->route('site.index');
    }
}
