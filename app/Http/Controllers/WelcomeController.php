<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Esse arquivo pode ser feito no terminal com o comando 'php artisan make:controller 'ControllerName' -i ;; ou --invokable'
class WelcomeController extends Controller
{
    public function __invoke() {
        return view('welcome');
    }
}
