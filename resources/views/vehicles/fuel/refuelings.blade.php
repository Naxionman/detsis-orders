@extends('template')

@section('title', 'Ανεφοδιασμοί - Detsis Orders')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Ανεφοδιασμοί όλων των οχημάτων</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Αρχική σελίδα</a></li>
            <li class="breadcrumb-item"><a href="/vehicles">Οχήματα</a></li>
            <li class="breadcrumb-item active">Ανεφοδιασμοί</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                    Πίνακας ανεφοδιασμών
            </div>
            <div class="card-body">
                <table id="refuelingsTable" class="cell-border display compact">
                    <thead>
                        <tr >
                            <th>Ημερομηνία</th>
                            <th>Όχημα</th>
                            <th>Ποσό</th>
                            <th>Στοιχεία Ελέγχου</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Ημερομηνία</th>
                            <th>Όχημα</th>
                            <th>Ποσό</th>
                            <th>Στοιχεία Ελέγχου</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    @forelse ($refuelings as $refuel)
                        <tr>
                            <td>{{ $refuel->refuel_date->format('d-m-Y') }}</td>
                            <td>{{ $refuel->vehicle->name }}</td>
                            <td class="text-end pe-4">{{ number_format($refuel->amount,2,",",".") }} €</td>
                            <td style="width:15%" >
                                <div class="d-flex justify-content-evenly">
                                    <a href="/edit_vehicle/{{ $refuel->id }}" class="btn btn-sm btn-warning flex-fill">
                                        <i class="far fa-edit"></i>Edit</a>
                                        <form action="/refuelings/{{ $refuel->id }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                            <button class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></button>
                                        </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <strong> Δεν υπάρχουν καταχωρημένοι ανεφοδιασμοί στην βάση δεδομένων.</strong>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
</div>
<script type = "text/javascript">
    $(document).ready( function () {$('#refuelingsTable').DataTable({
        columnDefs: [{ 
            type: 'date-eu', targets: [0] }]}  
    );});</script>
@endsection
