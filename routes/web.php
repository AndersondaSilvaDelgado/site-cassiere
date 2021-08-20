<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\{
    HomeController,
    CarrinhoController
};
use App\Http\Controllers\Painel\{
    AdminController,
    ProdutoController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('site.index');
Route::get('/produto/{id}', [HomeController::class, 'produto'])->name('site.produto');

Route::get('/carrinho', [CarrinhoController::class, 'index'])->name('site.carrinho.index');
Route::post('/carrinho/adicionar', [CarrinhoController::class, 'adicionar'])->name('site.carrinho.adicionar');
Route::delete('/carrinho/remover', [CarrinhoController::class, 'remover'])->name('site.carrinho.remover');
Route::post('/carrinho/concluir', [CarrinhoController::class, 'concluir'])->name('site.carrinho.concluir');
Route::get('/carrinho/compras', [CarrinhoController::class, 'compras'])->name('site.carrinho.compras');
Route::get('/carrinho/endereco', [CarrinhoController::class, 'endereco'])->name('site.carrinho.endereco');
Route::post('/carrinho/cancelar', [CarrinhoController::class, 'cancelar'])->name('site.carrinho.cancelar');
Route::get('/carrinho/pagamento', [CarrinhoController::class, 'pagamento'])->name('site.carrinho.pagamento');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/produto/create', [ProdutoController::class, 'create'])->name('admin.produto.create');
Route::post('/admin/produto', [ProdutoController::class, 'store'])->name('admin.produto.store');
Route::get('/admin/produto', [ProdutoController::class, 'index'])->name('admin.produto.index');
Route::get('/admin/produto/edit/{id}', [ProdutoController::class, 'edit'])->name('admin.produto.edit');
Route::put('/admin/produto/update/{id}', [ProdutoController::class, 'update'])->name('admin.produto.update');
Route::post('/admin/produto/delete', [ProdutoController::class, 'destroy'])->name('admin.produto.delete');

require __DIR__.'/auth.php';
