<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Controllers\Controller;
use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;

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
        $contacts = Contact::latest()->where(function ($query) {
            if ($companyId = request()->query("company_id")) {
                $query->where("company_id", $companyId);
            }
        })->paginate(10);

        return view('contacts.index', compact('contacts', 'companies'));
    }

    public function create() {
        //dd(request()->is("contacts")); FALSE
        //dd(request()->fullUrl()); method()

        $companies = $this->company->pluck();
        return view('contacts.create', compact('companies'));
    }

    public function store(Request $request)
    {   
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'company_id' => 'required|exists:companies,id'
        ]);

        $contact = Contact::create($request->all());
        return redirect()->route('contacts.index')->with('message', 'Contact has been added successfully');

        //dd(request()->is("contacts")); TRUE
        //dd($request->all());
    }

    public function show($id) {
        $contact = Contact::findOrFail($id);

        return view('contacts.show')->with('contact', $contact);

        //abort_if(empty($contact), 404);
        //Tem o abort_if(!) que faz a mesma coisa...; Se não houver o Id para este contato, retorna uma página 404.
    } 
}
