@extends('template')

@section('title', 'Μισθοδοσία - Detsis Orders')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Μισθοδοσία</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/">Αρχική σελίδα</a></li>
                <li class="breadcrumb-item">Εργαζόμενοι</li>
                <li class="breadcrumb-item active">Μισθοδοσία</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-4"> 
                            <i class="fas fa-table me-1"></i>
                            Πίνακας Μισθοδοσίας Eργαζομένων
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="salariesTable" class="cell-border display compact">
                        <thead>
                            <tr>
                                <th>Επώνυμο</th>
                                <th>Όνομα</th>
                                <th>Οικ.Κατάσταση</th>
                                <th>Τέκνα</th>
                                <th>Ημέρες εργασίας</th>
                                <th>Ώρες (εβδ.)</th>
                                <th>Ειδικότητα</th>
                                <th>Μισθός</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Επώνυμο</th>
                                <th>Όνομα</th>
                                <th>Οικ.Κατάσταση</th>
                                <th>Τέκνα</th>
                                <th>Ημέρες εργασίας</th>
                                <th>Ώρες (εβδ.)</th>
                                <th>Ειδικότητα</th>
                                <th>Μισθός</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        @forelse ($employees as $employee)
                            <tr>
                                <td>{{ $employee->surname }}</td>
                                <td>{{ $employee->first_name }}</td>
                                <td>{{ $employee->marital_status }}</td>
                                <td>{{ $employee->children }}</td>
                                <td>{{ $employee->working_days }}</td>
                                <td>{{ $employee->working_hours}}</td>
                                <td>{{ $employee->speciality }}</td>
                                <td>{{ number_format($gross[$employee->id],2,",",".") }} €</td>
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
        $(document).ready( function () {$('#salariesTable').DataTable()});
    </script>
@endsection