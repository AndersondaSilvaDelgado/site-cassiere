<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        return view('site.index');
    }

    public function index2()
    {
        $registros = Produto::where([
            'ativo' => 'S'
            ])->get();

        return view('home.index', compact('registros'));
    }

    public function produto($id = null)
    {
        if( !empty($id) ) {
            $registro = Produto::where([
                'id'    => $id,
                'ativo' => 'S'
                ])->first();

            if( !empty($registro) ) {
                return view('home.produto', compact('registro'));
            }
        }
        return redirect()->route('index');
    }
}
