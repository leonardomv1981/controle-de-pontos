<?php

use App\Http\Controllers\ProdutosmilhasController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::prefix('produtos-milhas')->group(function () {
    Route::get('/', [ProdutosmilhasController::class, 'index'])->name('produto-milhas.index');
    Route::get('/cadastrarProdutoMilha', [ProdutosmilhasController::class, 'cadastrarProdutoMilha'])->name('produtoMilha.cadastrar');
    Route::post('/cadastrarProdutoMilha', [ProdutosmilhasController::class, 'cadastrarProdutoMilha'])->name('produtoMilha.cadastrar');
    
    Route::delete('/delete', [ProdutosmilhasController::class, 'delete'])->name('produto-milhas.delete');
    Route::post('/action',  [ProdutosmilhasController::class, 'action'])->name('produtoMilha.action');
});