@extends('template')

@section('title', 'Επεξεργασία πελάτη - DetsisOrders')

@section('content')
<div class="container">
    <div class="card bg-success bg-opacity-25 shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 ">Επεξεργασία στοιχείων πελάτη</h3></div>
            <div class="card-body bg-light">
                <form action="/edit_client/{{ $client->id }}" id="editClient" method="POST">
                    @method('PATCH')
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputSurname">Επώνυμο πελάτη</label></div>
                        <div class="col-sm-4"><input class="form-control" value="{{ $client->surname }}" type="text" id="inputSurname" name="surname" required="required" data-error="Πρέπει να δώσετε όνομα πελάτη!" autofocus></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputName">Όνομα πελάτη</label></div>
                        <div class="col-sm-4"><input class="form-control" value="{{ $client->name }}" type="text" id="inputName" name="name"></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputEmail">E-mail</label></div>
                        <div class="col-sm-4"><input class="form-control" value="{{ $client->email }}" type="email" id="inputEmail" name="email" data-error="Δεν έχετε βάλει έγκυρο e-mail!"></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputMobile">Κινητό τηλέφωνο</label></div>
                        <div class="col-sm-4"><input class="form-control" value="{{ $client->mobile }}" type="tel" id="inputMobile" name="mobile"></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputPhone2">Τηλέφωνο 2</label></div>
                        <div class="col-sm-4"><input class="form-control" value="{{ $client->phone2 }}" type="tel" id="inputPhone2" name="phone2" ></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputAddress">Διεύθυνση</label></div>
                        <div class="col-sm-4"><input class="form-control" value="{{ $client->address }}" type="text" id="inputAddress" name="address"></div>
                    </div>
                    
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-10">
                            <label for="inputNotes">Σημειώσεις</label>
                            <textarea form="editClient" name="notes" id="inputNotes" cols="90" rows="10">{{ $client->notes }}</textarea>
                        </div>
                    </div>
                    @csrf
                </form>
            </div>
            <div class="card-footer text-center py-2">
                <button class="btn btn-danger shadow-sm" type="submit" form="editClient">  Αποθήκευση  </button>
                <a href="/clients" class="btn btn-info shadow-sm">  Ακύρωση - Επιστροφή </a>
            </div>
        </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <audio autoplay src="/sound/beep.mp3"/>
    @endif

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
</div>
@endsection