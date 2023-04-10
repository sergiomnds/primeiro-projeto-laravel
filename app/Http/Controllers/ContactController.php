<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Controllers\Controller;
use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            
        })->where(function($query) {
            if($search = request()->query('search')) {
                $query->where('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            }
        })->paginate(10);
        return view('contacts.index', compact('contacts', 'companies'));
    }

    public function create() {
        //dd(request()->is("contacts")); FALSE
        //dd(request()->fullUrl()); method()

        $companies = $this->company->pluck();
        $contact = new Contact();
        return view('contacts.create', compact('companies', 'contact'));
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

    public function edit($id) {
        $contact = Contact::findOrFail($id);
        $companies = $this->company->pluck();

        return view('contacts.edit', compact('contact', 'companies'));

        //abort_if(empty($contact), 404);
        //Tem o abort_if(!) que faz a mesma coisa...; Se não houver o Id para este contato, retorna uma página 404.
    }

    public function update(Request $request, $id)
    {   
        $contact = Contact::findOrFail($id);
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'company_id' => 'required|exists:companies,id'
        ]);

        $contact->update($request->all());
        return redirect()->route('contacts.index')->with('message', 'Contact has been updated successfully');

        //dd(request()->is("contacts")); TRUE
        //dd($request->all());
    }

    public function destroy($id) {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        //return back()->with('message', 'Contact has been deleted successfully');
        return redirect()->route('contacts.index')->with('message', 'Contact has been removed successfully');
    }
}
