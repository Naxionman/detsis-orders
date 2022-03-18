@extends('template')

@section('title', 'KTEO οχημάτων - Detsis Orders')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Έλεγχοι ΚΤΕΟ όλων των οχημάτων</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Αρχική σελίδα</a></li>
            <li class="breadcrumb-item"><a href="/vehicles">Οχήματα</a></li>
            <li class="breadcrumb-item active">Έλεγχοι ΚΤΕΟ</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                    Πίνακας ελέγχων ΚΤΕΟ
            </div>
            <div class="card-body">
                <table id="insurancesTable" class="cell-border display compact">
                    <thead>
                        <tr >
                            <th>Ημερομηνία ελέγχου</th>
                            <th>Ημερομηνία λήξης</th>
                            <th>Όχημα</th>
                            <th>Ποσό</th>
                            <th>Στοιχεία Ελέγχου</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Ημερομηνία ελέγχου</th>
                            <th>Ημερομηνία λήξης</th>
                            <th>Όχημα</th>
                            <th>Ποσό</th>
                            <th>Στοιχεία Ελέγχου</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    @forelse ($kteos as $kteo)
                        <tr>
                            <td>{{ $kteo->kteo_date->format('d-m-Y') }}</td>
                            <td>{{ $kteo->next_kteo_date->format('d-m-Y') }}</td>
                            <td>{{ $kteo->vehicle->name }}-{{$kteo->vehicle->plate}}</td>
                            <td>{{ number_format($kteo->amount,2,",",".") }} €</td>
                            <td style="width:15%" >
                                <div class="d-flex justify-content-evenly">
                                    <a href="/edit_kteo/{{ $kteo->id }}" class="btn btn-sm btn-warning flex-fill">
                                        <i class="far fa-edit"></i>Edit</a>
                                        <form action="/kteo/{{ $kteo->id }}" id="deleteForm" method="POST">
                                        @method('DELETE')
                                        @csrf
                                            <button class="btn btn-sm btn-danger show_confirm"><i class="far fa-trash-alt"></i></button>
                                        </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <strong> Δεν υπάρχουν καταχωρημένοι έλεγχοι ΚΤΕΟ στην βάση δεδομένων.</strong>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
</div>

<script type = "text/javascript">
    $(document).ready( function () {$('#insurancesTable').DataTable({
        columnDefs: [{ 
            type: 'date-eu', targets: [0,1] }]}  
        );});
</script>
@endsection
