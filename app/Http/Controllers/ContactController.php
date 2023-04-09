<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Controllers\Controller;
use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ContactController extends Controller
{
    public function __construct(protected CompanyRepository $company) {

    }

    public function index() {
        //dd($request->sort_by);
        // $companies = [
        //     1 => ['name' => 'Company One', 'contacts' => 3],
        //     2 => ['name' => 'Company Two', 'contacts' => 5],
        // ];
        $companies = $this->company->pluck();
        //$contacts = Contact::latest()->paginate(10);
        $contactsCollection = Contact::latest()->get();
        $perPage = 10;
        $currentPage = request()->query('page', 1);
        $items = $contactsCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->values();
        $total = $contactsCollection->count();
        $contacts = new LengthAwarePaginator($items, $total, $perPage, $currentPage, [
            'path' => request()->url(),
            'query' => request()->query()
        ]);

        return view('contacts.index', compact('contacts', 'companies'));
    }

    public function create() {
        return view('contacts.create');
    }

    public function show($id) {
        $contact = Contact::findOrFail($id);

        return view('contacts.show')->with('contact', $contact);

        //abort_if(empty($contact), 404);
        //Tem o abort_if(!) que faz a mesma coisa...; Se não houver o Id para este contato, retorna uma página 404.
    }
}
