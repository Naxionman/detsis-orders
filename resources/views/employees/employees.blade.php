@extends('template')

@section('title', 'DetsisOrders - Εργαζόμενοι')

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
                    <i class="fas fa-table me-1"></i>
                        Πίνακας εργαζομένων
                </div>
                <div class="card-body">
                    <table id="myTable" class="cell-border display compact">
                        <thead>
                            <tr>
                                <th>Επώνυμο</th>
                                <th>Όνομα</th>
                                <th>Κινητό</th>
                                <th>Ημερομηνία γέννησης</th>
                                <th>Ημερομηνία Πρόσληψης</th>
                                <th>Κάτι άλλο</th>
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
                                <th>Κάτι άλλο</th>
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        @forelse ($employees as $employee)
                            <tr>
                                <td>{{$employee->surname }}</td>
                                <td>{{$employee->first_name }}</td>
                                <td>{{$employee->mobile }}</td>
                                <td>{{$employee->date_of_birth->format('d-m-Y') }}</td>
                                <td>{{$employee->date_joined->format('d-m-Y') }}</td>
                                <td>0</td>
                                <td style="width:15%" >
                                    <div class="d-flex justify-content-evenly">
                                        <a href="/edit_employee/{{ $employee->id }}" class="btn btn-warning flex-fill">
                                            <i class="far fa-edit"></i>Επεξεργασία</a>
                                            <form action="/edit_employee/{{ $employee->id }}" method="POST">
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
    </div>
@endsection