@extends('template')

@section('title', 'Προσθήκη Άδειας - Detsis Orders')

@section('content')
<div class="container">
    <div class="card bg-info bg-opacity-50 shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 ">Εγγραφή άδειας εργαζόμενου</h3></div>
            <div class="card-body bg-light">
                <form action="add_leave" id="addLeave" method="POST">
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputEmployee">Εργαζόμενος</label></div>
                        <div class="col-sm-4">
                            <select class="js-example-basic-single form-control" id="inputEmployee" name="employee_id">
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->surname }} {{ $employee->first_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-2"><label for="inputStartDate">Πρώτη μέρα άδειας</label></div>
                        <div class="col-4"><input class="form-control" type="date" id="inputStartDate" name="start_date" required="required"></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-2"><label for="inputEndDate">Τελευταία μέρα άδειας</label></div>
                        <div class="col-4"><input class="form-control" type="date" id="inputEndDate" name="last_date" required="required"></div>
                    </div>
                    <br>
                    
                    <div class="row mt-3 justify-content-center">
                        <div class="col-4"><label>Ημέρες που δικαιούται :</label></div>
                        <div class="col-2"><strong id="daysEntitled"></strong></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-4"><label>Ημέρες που ζητά :</label></div>
                        <div class="col-2"><strong id="daysAsking"></strong></div>
                        <input name="days_taken" type="hidden" id="daysTaken">
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-2"><label id="explanation">Αναλυτικά :</label></div>
                        <div class="col-4">
                            <p id="explanationText1"></p>
                            <p id="explanationText2"></p>
                            <p id="explanationText3"></p>
                            <p id="explanationText4"></p>
                        </div>
                    </div>
                    @csrf
                </form>
            </div>
            <div class="card-footer text-center py-2">
                <button class="btn btn-danger shadow-sm" type="submit" form="addLeave">  Αποθήκευση  </button>
                <a href="/leaves" class="btn btn-info shadow-sm">  Ακύρωση - Επιστροφή </a>
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