<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index() {
        $companies = [
            1 => ['name' => 'Company One', 'contacts' => 3],
            2 => ['name' => 'Company Two', 'contacts' => 5],
        ];
    
        $contacts = $this->getContacts();
    
        return view('contacts.index', compact('contacts', 'companies'));
    }

    public function create() {
        return view('contacts.create');
    }

    public function show($id) {
        $contacts = $this->getContacts();
        abort_unless(isset($contacts[$id]), 404);
        //Tem o abort_if(!) que faz a mesma coisa...; Se não houver o Id para este contato, retorna uma página 404.
    
        $contact = $contacts[$id];
    
        return view('contacts.show')->with('contact', $contact);
    }

    protected function getContacts() {
        return [
            1 => ['id' => 1, 'name' => 'Name 1', 'phone' => '1234567890'],
            2 => ['id' => 2, 'name' => 'Name 2', 'phone' => '2345678901'],
            3 => ['id' => 3, 'name' => 'Name 3', 'phone' => '3456789012'],
        ];
    }
}