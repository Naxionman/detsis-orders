@extends('template')

@section('title', 'Άδειες - Detsis Orders')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Άδειες</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/">Αρχική σελίδα</a></li>
                <li class="breadcrumb-item"><a href="/employees">Εργαζόμενοι</a></li>
                <li class="breadcrumb-item active">Άδειες</li>
            </ol>
                <div class="card mb-4">
                    <a href="/add_leave" class="btn btn-info" >Προσθήκη Άδειας</a>    
                </div>
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-4"> 
                            <i class="fas fa-table me-1"></i>
                            Πίνακας Αδειών
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="leavesTable" class="cell-border display compact">
                        <thead>
                            <tr>
                                <th>Εργαζόμενος</th>
                                <th>Έναρξη άδειας</th>
                                <th>Έως</th>
                                <th>Ημέρες</th>
                                <th>Διακαιούται / Πήρε</th>
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Εργαζόμενος</th>
                                <th>Έναρξη άδειας</th>
                                <th>Έως</th>
                                <th>Ημέρες</th>
                                <th>Διακαιούται / Πήρε</th>
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        @forelse ($leaves as $leave)
                            <tr>
                                <td>{{ $leave->employee->surname }} {{ $leave->employee->first_name }}</td>
                                <td>{{ $leave->start_date->format('d-m-Y') }}</td>
                                <td>{{ $leave->last_date->format('d-m-Y') }}</td>
                                <td>
                                    @php
                                        $start = new DateTime($leave->start_date);
                                        $last = new DateTime($leave->last_date);
                                        $days = $start->diff( $last);
                                    @endphp
                                    {{ $days->d + 1 }}
                                </td>
                                <td>{{ $leave->employee->leave_days_entitled }} / {{ $leave->employee->leave_days_taken }}</td>
                                <td style="width:15%" >
                                    <div class="d-flex justify-content-evenly">
                                        <a href="/edit_leave/{{ $leave->id }}" class="btn btn-warning flex-fill">
                                            <i class="far fa-edit"></i>Edit</a>
                                            <form action="/leaves/{{ $leave->id }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                                <button class="btn btn-danger show_confirm"><i class="far fa-trash-alt"></i></button>
                                            </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            Δεν έχουν καταχωρηθεί άδειες.
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
        $(document).ready( function () {$('#leavesTable').DataTable({
            columnDefs: [{ 
                type: 'date-eu', targets: [1,2] }]}  
            );});
    </script>
@endsection