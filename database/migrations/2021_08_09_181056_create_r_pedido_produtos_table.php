<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRPedidoProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('r_pedido_produtos');
        Schema::create('r_pedido_produtos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pedido_id');
            $table->unsignedBigInteger('produto_id');
            $table->enum('status', ['RE', 'PA', 'CA']); // Reservado, Pago, Cancelado
            $table->decimal('valor_prod', 6, 2)->default(0);
            $table->decimal('desconto_prod', 6, 2)->default(0);
            $table->timestamps();
            $table->foreign('pedido_id')->references('id')->on('pedidos');
            $table->foreign('produto_id')->references('id')->on('produtos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('r_pedido_produtos');
    }
}
