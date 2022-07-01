<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProductController,
    AdminController,
    UserController
};

Route::get('/', function () {
    return view('index');
});

//Usuários
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

//Adm
Route::get('/admin/login', [AdminController::class, 'index'])->name('admin.index');

//Produtos
Route::get('/produtos/novo',[ProductController::class,'add'])->name('produtos.add');
Route::post('/produtos/novo',[ProductController::class,'store'])->name('produtos.store');
Route::get('/produtos', [ProductController::class, 'index'])->name('produtos.index');
Route::get('/produtos/{id}', [ProductController::class, 'idGet'])->name('produtos.idGet');