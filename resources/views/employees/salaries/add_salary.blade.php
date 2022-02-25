@extends('template')

@section('title', 'DetsisOrders - Προσθήκη μισθοδοσίας')

@section('content')
<div class="container">
    <div class="card bg-info bg-opacity-25 shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 ">Προσθήκη μισθοδοσίας</h3></div>
            <div class="card-body bg-light">
                <form action="/add_salary" id="addSalary" method="POST">
                    <div class="row justify-content-center">
                        <div class="col-3"><label for="selectedEmployee">Εργαζόμενος</label></div>
                        <div class="col-3">
                            <select class="form-control" name="employee_id" id="selectedEmployee">
                                <option value="null" selected>Επιλέξτε εργαζόμενο</option>
                                @foreach ($employees as $employee)
                                    <option value="{{$employee->id}}">{{ $employee->surname }} {{ $employee->first_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-3"><label>Μισθοδοσία μηνός / έτους :</label></div>
                        <div class="col-3">
                            <select class="form-control" name="salary_month">
                                <option value="Ιανουάριος">Ιανουάριος</option>
                                <option value="Φεβρουάριος">Φεβρουάριος</option>
                                <option value="Μάρτιος">Μάρτιος</option>
                                <option value="Απρίλιος">Απρίλιος</option>
                                <option value="Μάιος">Μάιος</option>
                                <option value="Ιούνιος">Ιούνιος</option>
                                <option value="Ιούλιος">Ιούλιος</option>
                                <option value="Αύγουστος">Αύγουστος</option>
                                <option value="Σεπτέμβριος">Σεπτέμβριος</option>
                                <option value="Οκτώβριος">Οκτώβριος</option>
                                <option value="Νοέμβριος">Νοέμβριος</option>
                                <option value="Δεκέμβριος">Δεκέμβριος</option>
                                <option value="Δώρο Πάσχα">Δώρο Πάσχα</option>
                                <option value="Δώρο Χριστουγέννων">Δώρο Χριστουγέννων</option>
                            </select>
                        </div>
                        <div class="col-1">
                            <input class="form-control" type="number" value="{{Date("Y")}}" step="1" min="2021" max="2050">
                        </div>
                    </div>

                    <div class="row justify-content-center" id="includeDiv">
                        
                    </div>
                    
                    
                    
                    @csrf
                </form>
            </div>
            <div class="card-footer text-center py-2">
                <button class="btn btn-danger shadow-sm" type="submit" form="addSalary">  Αποθήκευση  </button>
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