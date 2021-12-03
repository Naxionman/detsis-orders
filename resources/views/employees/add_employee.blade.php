@extends('template')

@section('title', 'DetsisOrders - Προσθήκη εργαζόμενου')

@section('content')
<div class="container">
    <div class="card bg-info bg-opacity-25 shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 ">Εγγραφή εργαζόμενου</h3></div>
            <div class="card-body bg-light">
                <form action="/add_employee" id="addEmployee" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col"><!-- Left Column -->
                            <div class="text-info text-center"><strong><h6>ΠΡΟΣΩΠΙΚΑ ΣΤΟΙΧΕΙΑ</h6></strong></div>
                            <hr style="margin-top: 0;">
                            <div class="row mt-1"> <!-- inner first row -->
                                <div class="col-sm-5">
                                    <label for="inputSurname" class="align-middle">Επώνυμο</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" autocomplete="nope" type="text" id="inputSurname" name="surname" placeholder="Επώνυμο"  required="required" autofocus>
                                </div>
                            </div>

                            <div class="row mt-1"> <!-- inner second row -->
                                <div class="col-sm-5">
                                    <label for="inputFirstName" class="align-middle">Όνομα</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" autocomplete="nope" type="text" id="inputFirstName" name="first_name" placeholder="Όνομα"  required="required">
                                </div>
                            </div>

                            <div class="row mt-1"> <!-- inner third row -->
                                <div class="col-sm-5">
                                    <label for="inputFatherName" class="align-middle">Όνομα Πατρός</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" autocomplete="nope" type="text" id="inputFatherName" name="father_name" placeholder="Όνομα Πατρός"  required="required">
                                </div>
                            </div>

                            <div class="row mt-1"> <!-- inner forth row -->
                                <div class="col-sm-5">
                                    <label for="inputMotherName" class="align-middle">Όνομα Μητρός</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" autocomplete="nope" type="text" id="inputMotherName" name="mother_name" placeholder="Όνομα Μητρός"  required="required">
                                </div>
                            </div>

                            <div class="row mt-1"> <!-- inner fifth row -->
                                <div class="col-sm-5">
                                    <label for="inputDateOfBirth" class="align-middle">Ημερομηνία γέννησης</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" autocomplete="nope" type="date" value="01-01-2000" id="inputDateOfBirth" name="date_of_birth" placeholder="Ημερομηνία γέννησης"  required="required">
                                </div>
                            </div>

                            <div class="row mt-1"> <!-- inner sixth row -->
                                <div class="col-sm-5">
                                    <label for="inputCitizenship" class="align-middle">Υπηκοότητα</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" autocomplete="nope" type="text" value="Ελληνική" id="inputCitizenship" name="citizenship" required="required">
                                </div>
                            </div>

                            <div class="row mt-1"> <!-- inner seventh row -->
                                <div class="col-sm-5">
                                    <label for="inputADT" class="align-middle">Αριθμός Δελτίου Ταυτότητας</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" autocomplete="nope" type="text" id="inputADT" name="adt" >
                                </div>
                            </div>

                            <div class="row mt-1"> <!-- inner eighth row -->
                                <div class="col-sm-5">
                                    <label for="inputAFM" class="align-middle">Αριθμός Φορολογικού Μητρώου</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" autocomplete="nope" type="number" id="inputAFM" name="afm" >
                                </div>
                            </div>

                            <div class="row mt-1"> <!-- inner nineth row -->
                                <div class="col-sm-5">
                                    <label for="inputAMKA" class="align-middle">AMKA</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" autocomplete="nope" type="number" id="inputAMKA" name="amka" >
                                </div>
                            </div>

                            <div class="row mt-1"> <!-- inner tenth row -->
                                <div class="col-sm-5">
                                    <label for="inputAMKA" class="align-middle">AMA</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" autocomplete="nope" type="number" id="inputAMA" name="ama" >
                                </div>
                            </div>
                            
                            <div class="row mt-1"> <!-- inner eleventh row -->
                                <div class="col-sm-5">
                                    <label for="inputMaritalStatus" class="align-middle">Οικογενειακή κατάσταση</label>
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-control" autocomplete="nope" type="text" id="inputMaritalStatus" name="marital_status" >
                                        <option value="Άγαμος">Άγαμος</option>
                                        <option value="Έγγαμος">Έγγαμος</option>
                                        <option value="Χήρος">Χήρος</option>
                                        <option value="Διαζευγμένος">Διαζευγμένος</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-1"> <!-- inner twelveth row -->
                                <div class="col-sm-5">
                                    <label for="inputChildren" class="align-middle">Αριθμός ανήλικων τέκνων</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" autocomplete="nope" type="number" id="inputChildren" name="children" >
                                </div>
                            </div>
                        </div>
                    
                        <div class="col"><!-- Right Column -->
                        <div class="text-info text-center"><strong><h6>ΕΡΓΑΣΙΑΚΑ ΣΤΟΙΧΕΙΑ</h6></strong></div>
                        <hr style="margin-top: 0;">
                            <div class="row mt-1"> <!-- inner fisrt row -->
                                <div class="col-sm-5">
                                    <label for="inputContractType" class="align-middle">Τύπος Σύμβασης</label>
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-control" autocomplete="nope" type="text" id="inputContractType" name="contract_type" >
                                        <option value="Αορίστου χρόνου">Αορίστου χρόνου</option>
                                        <option value="Ορισμένου χρόνου">Ορισμένου χρόνου</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-1"> <!-- inner second row -->
                                <div class="col-sm-5">
                                    <label for="inputContractExpiring" class="align-middle">Ημερομηνία λήξης</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" autocomplete="nope" type="date" id="inputContractExpiring" name="contract_expiring" placeholder="Ημερομηνία Λήξξης"">
                                </div>
                            </div>

                            <div class="row mt-1"> <!-- inner third row -->
                                <div class="col-sm-5">
                                    <label for="inputDateJoined" class="align-middle">Ημερομηνία Πρόσληψης</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" autocomplete="nope" type="date" id="inputDateJoined" name="date_joined" placeholder="Ημερομηνία Πρόσληψης"  required="required">
                                </div>
                            </div>

                            <div class="row mt-1"> <!-- inner fourth row -->
                                <div class="col-sm-5">
                                    <label for="inputDateLeft" class="align-middle">Ημερομηνία Αποχώρησης</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" autocomplete="nope" type="date" id="inputDateLeft" value="" name="date_left" placeholder="Ημερομηνία Αποχώρησης"">
                                </div>
                            </div>
                              
                            <div class="row mt-1"> <!-- inner fifth row -->
                                <div class="col-sm-5">
                                    <label for="inputSpeciality" class="align-middle">Ειδικότητα</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" autocomplete="nope" type="text" id="inputSpeciality" name="speciality" >
                                </div>
                            </div>

                            <div class="row mt-1 mb-5"> <!-- inner sixth row -->
                                <div class="col-sm-3">
                                    <label for="inputWorkingDays" class="align-middle">Ημέρες εργασίας</label>
                                </div>
                                <div class="col-sm-2">
                                    <input class="form-control" autocomplete="nope" type="number" value="6" id="inputWorkingDays" name="working_days" >
                                </div>
                                <div class="col-sm-3">
                                    <label for="inputWorkingHours" class="align-middle">Ώρες εργασίας</label>
                                </div>
                                <div class="col-sm-2">
                                    <input class="form-control" autocomplete="nope" type="number" value="40" id="inputWorkingHours" name="working_hours" >
                                </div>
                            </div>
                            
                            <div class="text-info text-center"><strong><h6>ΣΤΟΙΧΕΙΑ ΕΠΙΚΟΙΝΩΝΙΑΣ</h6></strong></div>
                            <hr style="margin-top: 0;">
                            <div class="row mt-1"> <!-- inner sixth row -->
                                <div class="col-sm-5">
                                    <label for="inputMobile" class="align-middle">Κινητό Τηλέφωνο</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" autocomplete="nope" type="number" id="inputMobile" name="mobile" >
                                </div>
                            </div>

                            <div class="row mt-1"> <!-- inner seventh row -->
                                <div class="col-sm-5">
                                    <label for="inputPhone2" class="align-middle">Σταθερό Τηλέφωνο</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" autocomplete="nope" type="number" id="inputPhone2" name="phone2" >
                                </div>
                            </div>

                            <div class="row mt-1"> <!-- inner eighth row -->
                                <div class="col-sm-5">
                                    <label for="inputEmail" class="align-middle">E-mail</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" autocomplete="nope" type="email" id="inputEmail" name="email" >
                                </div>
                            </div>

                        </div>


                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-10">
                            <label for="inputNotes">Σημειώσεις</label>
                            <input class="form-control" autocomplete="nope" type="text" id="inputNotes" name="notes" placeholder="Σημειώσεις">
                        </div>
                    </div>
                    </div>
                    
                    
                </form>
            </div>
            <div class="card-footer text-center py-2">
                <button class="btn btn-danger shadow-sm" type="submit" form="addEmployee">  Αποθήκευση  </button>
                <a href="/employees" class="btn btn-info shadow-sm">  Ακύρωση - Επιστροφή </a>
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