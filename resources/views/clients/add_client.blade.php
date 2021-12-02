@extends('template')

@section('title', 'DetsisOrders - Προσθήκη πελάτη')

@section('content')
<div class="container">
    <div class="card bg-success bg-opacity-25 shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 ">Εγγραφή πελάτη</h3></div>
            <div class="card-body bg-light">
                <form action="add_client" id="addClient" method="POST">
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputSurname">Επώνυμο πελάτη</label></div>
                        <div class="col-sm-4"><input class="form-control" autocomplete="nope" type="text" id="inputSurname" name="surname" required="required" data-error="Πρέπει να δώσετε όνομα πελάτη!" autofocus></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputName">Όνομα πελάτη</label></div>
                        <div class="col-sm-4"><input class="form-control" autocomplete="nope" type="text" id="inputName" name="name"></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputEmail">E-mail</label></div>
                        <div class="col-sm-4"><input class="form-control" autocomplete="off" type="email" id="inputEmail" name="email" data-error="Δεν έχετε βάλει έγκυρο e-mail!"></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputMobile">Κινητό τηλέφωνο</label></div>
                        <div class="col-sm-4"><input class="form-control" autocomplete="nope" type="tel" id="inputMobile" name="mobile"></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputPhone2">Τηλέφωνο 2</label></div>
                        <div class="col-sm-4"><input class="form-control" autocomplete="nope" type="tel" id="inputPhone2" name="phone2" ></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputAddress">Διεύθυνση</label></div>
                        <div class="col-sm-4"><input class="form-control" autocomplete="nope" type="text" id="inputAddress" name="address"></div>
                    </div>
                    
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-10">
                            <label for="inputNotes">Σημειώσεις</label>
                            <input class="form-control" autocomplete="nope" type="text" id="inputNotes" name="notes" placeholder="Σημειώσεις">
                        </div>
                    </div>
                    @csrf
                </form>
            </div>
            <div class="card-footer text-center py-2">
                <button class="btn btn-danger" type="submit" form="addClient">  Αποθήκευση  </button>
                <a href="/clients" class="btn btn-primary">  Ακύρωση - Επιστροφή </a>
            </div>
        </div>

        <div aria-live="polite" aria-atomic="true" class="bg-dark position-relative bd-example-toasts">
            <div class="toast-container position-absolute p-3" id="toastPlacement">
              <div class="toast">
                <div class="toast-header">
                  <img src="..." class="rounded me-2" alt="...">
                  <strong class="me-auto">Εγγραφή νέου πελάτη</strong>
                  <small>11 mins ago</small>
                </div>
                <div class="toast-body">
                  Η προσθήκη του πελάτη ήταν επιτυχής!
                </div>
              </div>
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