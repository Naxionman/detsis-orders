@extends('template')

@section('title', 'DetsisOrders - Προσθήκη προμηθευτή')

@section('content')
<div class="container">
    <div class="card bg-success bg-opacity-25 shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 ">Εγγραφή προμηθευτή</h3></div>
            <div class="card-body bg-light">
                <form action="add_supplier" id="addSupplier" method="POST">
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputCompanyName">Ονομασία Εταιρείας</label></div>
                        <div class="col-sm-4"><input class="form-control" autocomplete="nope" type="text" id="inputCompanyName" name="company_name" placeholder="Το όνομα της εταιρείας"  required="required" data-error="Πρέπει να δώσετε όνομα εταιρείας!" autofocus></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputSalesman">Πωλητής/Εκπρόσωπος</label></div>
                        <div class="col-sm-4"><input class="form-control" autocomplete="nope" type="text" id="inputSalesman" name="salesman" placeholder="Το όνομα του εκπροσώπου"></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputWebsite">Ιστοσελίδα</label></div>
                        <div class="col-sm-4"><input class="form-control" autocomplete="nope" type="url" id="inputWebsite" name="website" placeholder="Ιστοσελίδα εταιρείας" ></div>
                    </div>    
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputEmail">E-mail</label></div>
                        <div class="col-sm-4"><input class="form-control" autocomplete="off" type="email" id="inputEmail" name="email" placeholder="Ηλεκτρονική διεύθυνση της εταιρείας" data-error="Δεν έχετε βάλει έγκυρο e-mail!"></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputPhone1">Τηλέφωνο 1</label></div>
                        <div class="col-sm-4"><input class="form-control" autocomplete="nope" type="tel" id="inputPhone1" name="phone1" placeholder="Τηλέφωνο 1"></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputPhone2">Τηλέφωνο 2</label></div>
                        <div class="col-sm-4"><input class="form-control" autocomplete="nope" type="tel" id="inputPhone2" name="phone2" placeholder="Τηλέφωνο 2"></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputAddress">Διεύθυνση</label></div>
                        <div class="col-sm-4"><input class="form-control" autocomplete="nope" type="text" id="inputAddress" name="address" placeholder="Φυσική διεύθυνση της εταιρείας"></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputZipcode">Ταχυδρομικός κώδικας</label></div>
                        <div class="col-sm-4"><input class="form-control" autocomplete="nope" type="number" id="inputZipcode" name="zipcode" placeholder="Τ.Κ."></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputCity">Πόλη</label></div>
                        <div class="col-sm-4"><input class="form-control" autocomplete="nope" type="text" id="inputCity" name="city" placeholder="Πόλη"></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputAFM">ΑΦΜ</label></div>
                        <div class="col-sm-4"><input class="form-control" autocomplete="nope" type="number" id="inputAFM" name="afm" 
                            placeholder="Αριθμός φορολογικού μητρώου της εταιρείας" 
                            minlength="9" maxlength="9" data-error-message="Ο ΑΦΜ πρέπει να έχει 9 αριθμούς!"></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-10">
                            <label for="inputDescription">Περιγραφή ή άλλες παρατηρήσεις</label>
                            <input class="form-control" autocomplete="nope" type="text" id="inputDescription" name="description" placeholder="Σημειώσεις">
                        </div>
                    </div>
                    @csrf
                </form>
            </div>
            <div class="card-footer text-center py-2">
                <button class="btn btn-danger shadow-sm" type="submit" form="addSupplier">  Αποθήκευση  </button>
                <a href="javascript:history.back()" class="btn btn-info shadow-sm">  Ακύρωση - Επιστροφή </a>
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