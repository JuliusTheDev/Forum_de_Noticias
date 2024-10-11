<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\VendaController2;

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

Route::get('/', [IndexController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/categoria', [CategoriaController::class, 'listar']);
    Route::get('/categoria/novo', [CategoriaController::class, 'novo']);
    Route::post('/categoria/salvar', [CategoriaController::class, 'salvar']);
    Route::get('/categoria/excluir/{id}', [CategoriaController::class, 'excluir']);
    Route::get('/categoria/editar/{id}', [CategoriaController::class, 'editar']);
    Route::get('/categoria/pdf', [CategoriaController::class, 'pdf']);
    
    
    Route::get('/noticia', [NoticiaController::class, 'listar']);
    Route::get('/noticia/novo', [NoticiaController::class, 'novo']);
    Route::post('/noticia/salvar', [NoticiaController::class, 'salvar']);
    Route::get('/noticia/editar/{id}', [NoticiaController::class, 'editar']);
    Route::get('/noticia/excluir/{id}', [NoticiaController::class, 'excluir']);
    
    
    Route::get('/venda/listar', [VendaController::class, 'listar']);
    Route::get('/venda/novo', [VendaController::class, 'novo']);
    Route::post('/venda/salvar', [VendaController::class, 'salvar']);
    Route::get('/venda/editar/{id}', [VendaController::class, 'editar']);
    Route::get('/venda/editarItens/{id}', [VendaController::class, 'editarItens']);
    Route::post('/venda/salvarItens', [VendaController::class, 'salvarItens']);
    Route::post('/venda/deleteItem', [VendaController::class, 'deleteItem']);
    Route::get('/venda/excluir/{id}', [VendaController::class, 'excluir']);
    
    Route::get('/venda/listar2', [VendaController2::class, 'listar2']);
    Route::get('/venda/novo2', [VendaController2::class, 'novo2']);
    Route::get('/venda/editar2/{id}', [VendaController2::class, 'editar2']);
    Route::post('/venda/salvar2', [VendaController2::class, 'salvar2']);
    Route::get('/venda/excluir2/{id}', [VendaController2::class, 'excluir2']);
        
    Route::get('/cliente/listar', [ClienteController::class, 'listar']);
    Route::get('/cliente/mensagem/{id}', [ClienteController::class, 'mensagem']);
    Route::post('/cliente/enviarMensagem', [ClienteController::class, 'enviarMensagem']);

});

require __DIR__.'/auth.php';
