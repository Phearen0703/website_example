<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('role-list', [RoleController::class, 'index'])->name('role_list');
Route::get('role-create',[RoleController::class, 'create'])->name('role.create');
Route::post('role-store',[RoleController::class,'store'])->name('role.store');

Route::get('role-edit/{id}',[RoleController::class,'edit'])->name('role.edit');
Route::put('role-update/{id}',[RoleController::class, 'update'])->name('role.update');
Route::get('role-delete/{id}',[RoleController::class, 'destroy'])->name('role.delete');


Route::get('menu-list',[MenuController::class, 'index'])->name('menu_list');
Route::get('menu-cteate',[MenuController::class, 'create'])->name('menu.create');
Route::post('menu-store',[MenuController::class, 'store'])->name('menu.store');
Route::get('menu-edit/{id}',[MenuController::class, 'edit'])->name('menu.edit');


Route::put('menu-update/{id}',[MenuController::class, 'update'])->name('menu.update');
Route::get('menu-delete/{id}',[MenuController::class, 'destroy'])->name('menu.delete');


Route::get('post-list', [App\Http\Controllers\PostController::class, 'index'])->name('post_list');
Route::get('post-create', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');
Route::post('post-store', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');
Route::get('post-edit/{id}', [App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');
Route::put('post-update/{id}', [App\Http\Controllers\PostController::class, 'update'])->name('post.update');
Route::get('post-delete/{id}', [App\Http\Controllers\PostController::class, 'destroy'])->name('post.delete');