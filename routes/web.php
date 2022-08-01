<?php

use Illuminate\Support\Facades\Route;

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

// COMEÇO ROTAS GET
Route::get('/', [\App\Http\Controllers\Home::class, 'lastFolders'])->name('home.begin');
Route::get('/explorer', [\App\Http\Controllers\Folder::class, 'allFolders'])->name('folder.explorer');
Route::get('/meus-cartoes/{folder_id}', [\App\Http\Controllers\Card::class, 'studyCards'])->name('card.myCards');
Route::get('/criar-cartoes', [\App\Http\Controllers\Card::class, 'createGet'])->name('card.create');
Route::get('/editar-cartoes/{folder_id}', [\App\Http\Controllers\Card::class, 'editCardsGet'])->name('card.edit-get');
// FIM ROTAS GET

// COMEÇO ROTAS POST
Route::post('/edit-cards', [\App\Http\Controllers\Card::class, 'editCardsPost'])->name('card.edit-post');
Route::post('/delete-folder', [\App\Http\Controllers\Card::class, 'deleteFolder'])->name('card.delete-folder');
Route::post('/create-folder-card', [\App\Http\Controllers\Card::class, 'createFolderPost'])->name('card.create-folder-post');
Route::post('/create-array-cards', [\App\Http\Controllers\Card::class, 'createCardsPost'])->name('card.create-cards-post');
Route::post('/delete-folder/{folder_id}', [\App\Http\Controllers\Folder::class, 'deleteFolder'])->name('folder.delete');
// FIM ROTAS POST
