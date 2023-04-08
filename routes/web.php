<?php

use App\Http\Controllers\ContactController;
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
    return view('welcome');
});

//Agrupando as Rotas pelo Controller em comum, faz fica mais limpo o código.
Route::controller(ContactController::class)->group(function () {
    Route::get('/contacts', 'index')->name('index');

    Route::get('/contacts/create', 'create')->name('create');

    //O id é um parâmetro passado na URL, que pode ser acessado dentro da função. Muda para os diferentes contatos.
    Route::get('/contacts/{id}', 'show')->name('show')->whereNumber('id');
    //Para aceitar apenas números -> where('i d', '[0-9]+');
});

Route::fallback(function() {
    return "<h1>Sorry, the page does not exists</h1>";
});

/*
As routes podem ser colocadas em grupos, usando o prefix(), que também pode ter um nome.
Route::prefix('admin')->name('admin.')->group(function () {

});
*/

/*
O name é um parâmetro opcional, indicado pelo ?, tem que ter um valor default.
Se é opcional, é null.
Route::get('/companies/{name?}', function ($name = null) {
    if ($name) {
        return "Company " . $name;
    } else {
        return "All Companies";
    }
})->whereAlphaNumeric('name'); //Para aceitar apenas letras -> where('name', '[a-zA-Z]+');
*/