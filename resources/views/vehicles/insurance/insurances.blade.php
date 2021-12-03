@extends('template')

@section('title', 'Ασφάλειες οχημάτων - Detsis Orders')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Ασφάλειες όλων των οχημάτων</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Αρχική σελίδα</a></li>
            <li class="breadcrumb-item"><a href="/vehicles">Οχήματα</a></li>
            <li class="breadcrumb-item active">Ασφάλειες</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                    Πίνακας ασφαλειών
            </div>
            <div class="card-body">
                <table id="insuranceTable" class="cell-border display compact">
                    <thead>
                        <tr >
                            <th>Ημερομηνία έναρξης</th>
                            <th>Ημερομηνία λήξης</th>
                            <th>Όχημα</th>
                            <th>Ασφαλιστική</th>
                            <th>Ποσό</th>
                            <th>Στοιχεία Ελέγχου</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Ημερομηνία έναρξης</th>
                            <th>Ημερομηνία λήξης</th>
                            <th>Όχημα</th>
                            <th>Ασφαλιστική</th>
                            <th>Ποσό</th>
                            <th>Στοιχεία Ελέγχου</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    @forelse ($insurances as $insurance)
                        <tr>
                            <td>{{ $insurance->insurance_date->format('d-m-Y') }}</td>
                            <td>{{ $insurance->expiry_date->format('d-m-Y') }}</td>
                            <td>{{ $insurance->vehicle->name }}</td>
                            <td>{{ $insurance->insurance_company }}</td>
                            <td>{{ $insurance->amount }} €</td>
                            <td style="width:15%" >
                                <div class="d-flex justify-content-evenly">
                                    <a href="/edit_insurance/{{ $insurance->id }}" class="btn btn-warning flex-fill">
                                        <i class="far fa-edit"></i>Edit</a>
                                        <form action="/insurances/{{ $insurance->id }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                            <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
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

<script type = "text/javascript">$(document).ready( function () {$('#insuranceTable').DataTable();});</script>
@endsection
