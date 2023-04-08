<?php

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

function getContacts() {
    return [
        1 => ['name' => 'Name 1', 'phone' => '1234567890'],
        2 => ['name' => 'Name 2', 'phone' => '2345678901'],
        3 => ['name' => 'Name 3', 'phone' => '3456789012'],
    ];
}

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contacts', function() {
    $contacts = getContacts();

    return view('contacts.index', compact('contacts'));
})->name('contacts.index');

Route::get('/contacts/create', function() {
    return view('contacts.create');
})->name('contacts.create');

//O id é um parâmetro passado na URL, que pode ser acessado dentro da função. Muda para os diferentes contatos.
Route::get('/contacts/{id}', function($contactId) {
    $contacts = getContacts();
    abort_unless(isset($contacts[$contactId]), 404);
    //Tem o abort_if(!) que faz a mesma coisa...; Se não houver o Id para este contato, retorna uma página 404.

    $contact = $contacts[$contactId];

    return view('contacts.show')->with('contact', $contact); //Pode colocar outro with(), para caso com mais parametros.
})->name('contacts.show')->whereNumber('id'); //Para aceitar apenas números -> where('i d', '[0-9]+');

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