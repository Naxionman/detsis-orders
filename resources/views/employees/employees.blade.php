@extends('template')

@section('title', 'Εργαζόμενοι - Detsis Orders')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Εργαζόμενοι</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/">Αρχική σελίδα</a></li>
                <li class="breadcrumb-item active">Εργαζόμενοι</li>
            </ol>
                <div class="card mb-4">
                    <a href="/add_employee" class="btn btn-info" >Προσθήκη εργαζόμενου</a>    
                </div>
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-4"> 
                            <i class="fas fa-table me-1"></i>
                            Πίνακας Eργαζομένων
                        </div>
                        <div class="col-8">Συγκεντρωτικοί πίνακες : 
                            <a class="btn btn-dark" href="/leaves">Άδειες</a>
                            <a class="btn btn-dark" href="/salaries">Μισθοδοσία</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="employeesTable" class="cell-border display compact">
                        <thead>
                            <tr>
                                <th>Επώνυμο</th>
                                <th>Όνομα</th>
                                <th>Κινητό</th>
                                <th>Ημερομηνία γέννησης</th>
                                <th>Ημερομηνία Πρόσληψης</th>
                                <th>Άδειες</th>
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Επώνυμο</th>
                                <th>Όνομα</th>
                                <th>Κινητό</th>
                                <th>Ημερομηνία γέννησης</th>
                                <th>Ημερομηνία Πρόσληψης</th>
                                <th>Άδειες</th>
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        @forelse ($employees as $employee)
                            <tr>
                                <td>{{ $employee->surname }}</td>
                                <td>{{ $employee->first_name }}</td>
                                <td>{{ $employee->mobile }}</td>
                                <td>{{ $employee->date_of_birth->format('d-m-Y') }}</td>
                                <td>{{ $employee->date_joined->format('d-m-Y') }}</td>
                                <td>{{ $employee->leave_days_entitled }} / {{ $employee->leave_days_taken }}</td>
                                <td style="width:15%" >
                                    <div class="d-flex justify-content-evenly">
                                        <a href="/edit_employee/{{ $employee->id }}" class="btn btn-warning flex-fill">
                                            <i class="far fa-edit"></i>Edit</a>
                                            <form action="/employees/{{ $employee->id }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                                <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                            </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            Δεν έχουν καταχωρηθεί εργαζόμενοι.
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {!! Toastr::message() !!}
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"type="text/javascript"></script>
    <script type="text/javascript" src="https:////cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.11/sorting/date-eu.js"></script>

    <script type = "text/javascript">
        $(document).ready( function () {$('#employeesTable').DataTable({
            columnDefs: [{ 
                type: 'date-eu', targets: [3,4] }]}  
            );});
    </script>
@endsection