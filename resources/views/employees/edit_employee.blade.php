@extends('template')

@section('title', 'DetsisOrders - Επεξεργασία στοιχείων εργαζόμενου')

@section('content')
<div class="container">
    <div class="card bg-warning bg-opacity-25 shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 ">Επεξεργασία στοιχείων εργαζόμενου</h3></div>
            <div class="card-body bg-light">
                <form action="/edit_employee/{{ $employee->id }}" id="editEmployee" method="POST">
                    @method("PATCH")
                    <div class="row">
                        <div class="col"><!-- Left Column -->
                            <div class="text-info text-center"><strong><h6>ΠΡΟΣΩΠΙΚΑ ΣΤΟΙΧΕΙΑ</h6></strong></div>
                            <hr style="margin-top: 0;">
                            <div class="row mt-1"> <!-- inner first row -->
                                <div class="col-sm-5">
                                    <label for="inputSurname" class="align-middle">Επώνυμο</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" value = "{{ $employee->surname }}" autocomplete="nope" type="text" id="inputSurname" name="surname" placeholder="Επώνυμο"  required="required" autofocus>
                                </div>
                            </div>

                            <div class="row mt-1"> <!-- inner second row -->
                                <div class="col-sm-5">
                                    <label for="inputFirstName" class="align-middle">Όνομα</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" value = "{{ $employee->first_name }}" autocomplete="nope" type="text" id="inputFirstName" name="first_name" placeholder="Όνομα"  required="required">
                                </div>
                            </div>

                            <div class="row mt-1"> <!-- inner third row -->
                                <div class="col-sm-5">
                                    <label for="inputFatherName" class="align-middle">Όνομα Πατρός</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" value = "{{ $employee->father_name }}" autocomplete="nope" type="text" id="inputFatherName" name="father_name" placeholder="Όνομα Μητρός"  required="required">
                                </div>
                            </div>

                            <div class="row mt-1"> <!-- inner forth row -->
                                <div class="col-sm-5">
                                    <label for="inputMotherName" class="align-middle">Όνομα Πατρός</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" value = "{{ $employee->mother_name }}" autocomplete="nope" type="text" id="inputMotherName" name="mother_name" placeholder="Όνομα Μητρός"  required="required">
                                </div>
                            </div>

                            <div class="row mt-1"> <!-- inner fifth row -->
                                <div class="col-sm-5">
                                    <label for="inputDateOfBirth" class="align-middle">Ημερομηνία γέννησης</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" value = "{{ $employee->date_of_birth == null ?: $employee->date_of_birth->format("Y-m-d") }}" type="date"  id="inputDateOfBirth" name="date_of_birth" required="required">
                                </div>
                            </div>

                            <div class="row mt-1"> <!-- inner sixth row -->
                                <div class="col-sm-5">
                                    <label for="inputCitizenship" class="align-middle">Υπηκοότητα</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" value = "{{ $employee->citizenship }}" autocomplete="nope" type="text" value="Ελληνική" id="inputCitizenship" name="citizenship" required="required">
                                </div>
                            </div>

                            <div class="row mt-1"> <!-- inner seventh row -->
                                <div class="col-sm-5">
                                    <label for="inputADT" class="align-middle">Αριθμός Δελτίου Ταυτότητας</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" value = "{{ $employee->adt }}" autocomplete="nope" type="text" id="inputADT" name="adt" >
                                </div>
                            </div>

                            <div class="row mt-1"> <!-- inner eighth row -->
                                <div class="col-sm-5">
                                    <label for="inputAFM" class="align-middle">Αριθμός Φορολογικού Μητρώου</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" value = "{{ $employee->afm }}" autocomplete="nope" type="number" id="inputAFM" name="afm" >
                                </div>
                            </div>

                            <div class="row mt-1"> <!-- inner nineth row -->
                                <div class="col-sm-5">
                                    <label for="inputAMKA" class="align-middle">AMKA</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" value = "{{ $employee->amka }}" autocomplete="nope" type="number" id="inputAMKA" name="amka" >
                                </div>
                            </div>

                            <div class="row mt-1"> <!-- inner tenth row -->
                                <div class="col-sm-5">
                                    <label for="inputAMKA" class="align-middle">AMA</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" value = "{{ $employee->ama }}" autocomplete="nope" type="number" id="inputAMA" name="ama" >
                                </div>
                            </div>
                            
                            <div class="row mt-1"> <!-- inner eleventh row -->
                                <div class="col-sm-5">
                                    <label for="inputMaritalStatus" class="align-middle">Οικογενειακή κατάσταση</label>
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-control" value = "" autocomplete="nope" type="text" id="inputMaritalStatus" name="marital_status" >
                                        <option value="{{ $employee->marital_status }}" selected>{{ $employee->marital_status }}</option>
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
                                    <input class="form-control" value = "{{ $employee->children }}" autocomplete="nope" type="number" id="inputChildren" name="children" >
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
                                    <select class="form-control" value = "{{ $employee->contract_type }}" type="text" id="inputContractType" name="contract_type" >
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
                                    <input class="form-control" value = "{{ $employee->contract_expiring == null ?: $employee->contract_expiring->format('Y-m-d') }}" type="date" id="inputContractExpiring" name="contract_expiring">
                                </div>
                            </div>

                            <div class="row mt-1"> <!-- inner third row -->
                                <div class="col-sm-5">
                                    <label for="inputDateJoined" class="align-middle">Ημερομηνία Πρόσληψης</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" value = "{{ $employee->date_joined == null ?: $employee->date_joined->format('Y-m-d') }}" type="date" id="inputDateJoined" name="date_joined" required="required">
                                </div>
                            </div>

                            <div class="row mt-1"> <!-- inner fourth row -->
                                <div class="col-sm-5">
                                    <label for="inputDateLeft" class="align-middle">Ημερομηνία Αποχώρησης</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" value = "{{ $employee->date_left == null ?: $employee->date_left->format('Y-m-d')  }}" type="date" id="inputDateLeft" name="date_left" >
                                </div>
                            </div>
                              
                            <div class="row mt-1"> <!-- inner fifth row -->
                                <div class="col-sm-5">
                                    <label for="inputSpeciality" class="align-middle">Ειδικότητα</label>
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-control" value = "{{ $employee->speciality }}" type="text" id="inputSpeciality" name="speciality" >
                                        <option value="Εργατοτεχνίτης">Εργατοτεχνίτης</option>
                                        <option value="Υπάλληλος">Υπάλληλος</option>
                                    </select>    
                                </div>
                            </div>

                            <div class="row mt-1 mb-1"> <!-- inner sixth row -->
                                <div class="col-sm-3">
                                    <label for="inputWorkingDays" class="align-middle">Ημέρες εργασίας</label>
                                </div>
                                <div class="col-sm-2">
                                    <input class="form-control" value = "{{ $employee->working_days }}" autocomplete="nope" type="number" value="6" id="inputWorkingDays" name="working_days" >
                                </div>
                                <div class="col-sm-3">
                                    <label for="inputWorkingHours" class="align-middle">Ώρες εργασίας</label>
                                </div>
                                <div class="col-sm-2">
                                    <input class="form-control" value = "{{ $employee->working_hours }}" autocomplete="nope" type="number" value="40" id="inputWorkingHours" name="working_hours" >
                                </div>
                            </div>
                            
                            <div class="row mt-1 mb-5"> <!-- inner seventh row -->
                                <div class="col-sm-3">
                                    <label for="inputWorkingDays" class="align-middle">Ημέρες Αδείας δικαιούται</label>
                                </div>
                                <div class="col-sm-2">
                                    <input class="form-control" value = "{{ $employee->leave_days_entitled }}" autocomplete="nope" type="number" id="inputLeaveDaysEntitled" name="leave_days_entitled" >
                                </div>
                                <div class="col-sm-3">
                                    <label for="inputWorkingHours" class="align-middle">Ημέρες που έχει πάρει</label>
                                </div>
                                <div class="col-sm-2">
                                    <input class="form-control" value = "{{ $employee->leave_days_taken }}" autocomplete="nope" type="number" id="inputLeaveDaysTaken" name="leave_days_taken" >
                                </div>
                            </div>
                            
                            <div class="text-info text-center"><strong><h6>ΣΤΟΙΧΕΙΑ ΕΠΙΚΟΙΝΩΝΙΑΣ</h6></strong></div>
                            <hr style="margin-top: 0;">
                            <div class="row mt-1"> <!-- inner sixth row -->
                                <div class="col-sm-5">
                                    <label for="inputMobile" class="align-middle">Κινητό Τηλέφωνο</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" value = "{{ $employee->mobile }}" autocomplete="nope" type="number" id="inputMobile" name="mobile" >
                                </div>
                            </div>

                            <div class="row mt-1"> <!-- inner seventh row -->
                                <div class="col-sm-5">
                                    <label for="inputPhone2" class="align-middle">Σταθερό Τηλέφωνο</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" value = "{{ $employee->phone2 }}" autocomplete="nope" type="number" id="inputPhone2" name="phone2" >
                                </div>
                            </div>

                            <div class="row mt-1"> <!-- inner eighth row -->
                                <div class="col-sm-5">
                                    <label for="inputEmail" class="align-middle">E-mail</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" value = "{{ $employee->email }}" autocomplete="nope" type="email" id="inputEmail" name="email" >
                                </div>
                            </div>

                        </div>

                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-10">
                            <label for="inputNotes">Σημειώσεις</label>
                            <input class="form-control" value = "{{ $employee->notes }}" autocomplete="nope" type="text" id="inputNotes" name="notes" placeholder="Σημειώσεις">
                        </div>
                    </div>
                    </div>
                    @csrf
                </form>
            </div>
            <div class="card-footer text-center py-2">
                <button class="btn btn-danger shadow-sm" type="submit" form="editEmployee">  Αποθήκευση Αλλαγών  </button>
                <a href="/employees" class="btn btn-info shadow-sm">  Ακύρωση - Επιστροφή </a>
            </div>
        </div>
        

@endsection