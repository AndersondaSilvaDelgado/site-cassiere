<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = [
        'user_id',
        'status'
    ];

    public function pedido_produtos()
    {
        return $this->hasMany('App\Models\RPedidoProduto')
            ->select(DB::raw('produto_id, sum(valor) as valores, count(1) as qtd') )
            ->groupBy('produto_id')
            ->orderBy('produto_id', 'desc');
    }

    public function pedido_produtos_itens()
    {
        return $this->hasMany('App\Models\RPedidoProduto');
    }

    public static function consultaId($where)
    {
        $pedido = self::where($where)->first(['id']);
        return !empty($pedido->id) ? $pedido->id : null;
    }

}
