<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RPedidoProduto extends Model
{
    use HasFactory;

    protected $table = 'r_pedido_produtos';

    protected $fillable = [
        'pedido_id',
        'produto_id',
        'status',
        'valor'
    ];

    public function produto()
    {
        return $this->belongsTo('App\Models\Produto', 'produto_id', 'id');
    }

}
