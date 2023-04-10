@extends('layouts.main')

@section('title', 'Contact App | All Contacts')

@section('content')
    <main class="py-5">
        <div class="container">
        <div class="row">
            <div class="col-md-12">
            <div class="card">
                <div class="card-header card-title">
                    <div class="d-flex align-items-center">
                    <h2 class="mb-0">All Contacts</h2>
                    <div class="ml-auto">
                        <a href="{{ route('contacts.create') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add New</a>
                    </div>
                    </div>
                </div>
                <div class="card-body">
                        @include('contacts._filter')
                        @if ($message = session('message'))
                            <div class="alert alert-success">{{ $message }}</div>
                        @endif
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Company</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            {{--Pode usar o @unless OU @if, juntamente com o foreach que funciona de forma contrária--}}
                                @forelse ($contacts as $index => $contact) {{--junta os dois, ao usar o @empty --}}
                                    {{-- @continue($id == 1) usado para loops (começar)
                                    @break($id == 3) usado para loops (terminar)--}}
                                    @include('contacts._contact', ['contact' => $contact, 'index' => $index])
                                @empty
                                    @include('contact._empty')
                                @endforelse
                                {{-- @each('contacts._contact', $contacts, 'contact', 'contacts._empty') --}}
                                {{--Não traz as variaveis do view pai, então se precisar acessar é melhor usar o forelse--}}
                            {{-- *@elseif(count($contacts) == 1) 
                                *<p>There's only one contact</p> ;; Para adicionar mais condições--}}
                            
                        </tbody>
                    </table> 

                    {{ $contacts->withQueryString()->links() }}

                </div>
            </div>
            </div>
        </div>
        </div>
    </main>
@endsection