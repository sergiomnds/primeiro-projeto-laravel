<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactNoteController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\WelcomeController;
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
Route::get('/', WelcomeController::class);

//Agrupando as Rotas pelo Controller em comum, faz fica mais limpo o código.
Route::controller(ContactController::class)->name('contacts.')->group(function () {
    Route::get('/contacts', 'index')->name('index');
    Route::post('/contacts', 'store')->name('store');
    Route::get('/contacts/create', 'create')->name('create');

    //O id é um parâmetro passado na URL, que pode ser acessado dentro da função. Muda para os diferentes contatos.
    Route::get('/contacts/{id}', 'show')->name('show')->whereNumber('id');
    //Para aceitar apenas números -> where('i d', '[0-9]+');
});

Route::resource('/companies', CompanyController::class);
Route::resources([
    '/tags' => TagController::class,
    '/tasks' => TaskController::class
]);

//Partial Resource Routes, você escolhe quais quer criar a rota invés de todas como é o padrão. Tem o only() e o except()
// Route::resource('/activities', ActivityController::class)->except([
//     'index', 'show'
// ]);

//* Se quiser customizar os nomes e as rotas.
// Route::resource('/activities', ActivityController::class)->names([
//     'index' => 'activities.all',
//     'show' => 'activities.view'
// ]);

Route::resource('/activities', ActivityController::class)->parameters([
    'activities' => 'active'
]);

//Nested Resource, trabalhar apenas com as rotas necessárias
Route::resource('/contacts.notes', ContactNoteController::class)->shallow();

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