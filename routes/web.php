<?php

use App\Http\Controllers\ProdutosmilhasController;
use App\Http\Controllers\ProgramasController;
use App\Http\Controllers\SaldosController;
use App\Models\Programas;
use App\Models\Saldos as ModelsSaldos;
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
    $programas = Programas::all();
    dd($programas);
    return view('index', compact('programas'));
});

// Route::get('/programas', function () {
//     $programas = Programas::all();
//     return view('pages.programas.index', compact('programas'));
// });

Route::prefix('produtos-milhas')->group(function () {
    Route::get('/', [ProdutosmilhasController::class, 'index'])->name('produto-milhas.index');
    Route::get('/cadastrarProdutoMilha', [ProdutosmilhasController::class, 'cadastrarProdutoMilha'])->name('produtoMilha.cadastrar');
    Route::post('/cadastrarProdutoMilha', [ProdutosmilhasController::class, 'cadastrarProdutoMilha'])->name('cadastrar.produtoMilha');
    
    Route::get('/extrato', [ProdutosmilhasController::class, 'listarPorPrograma'])->name('produtoMilha.extrato');
   
    Route::delete('/delete', [ProdutosmilhasController::class, 'delete'])->name('produto-milhas.delete');
    Route::post('/action',  [ProdutosmilhasController::class, 'action'])->name('produtoMilha.action');
});

Route::prefix('programas')->group(function () {
    Route::get('/', [ProgramasController::class, 'index'])->name('programas.index');
    Route::post('/cadastrarProgramas', [ProgramasController::class, 'cadastrarProgramas'])->name('programas.cadastrar');
    Route::post('/action',  [ProgramasController::class, 'action'])->name('programas.action');

});

Route::prefix('saldos')->group(function () {
    Route::get('/', [SaldosController::class, 'index'])->name('saldos.index');

});
