@extends ('template')

@section('title', 'Πάγια έξοδα')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Πάγια έξοδα</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/">Αρχική σελίδα</a></li>
                <li class="breadcrumb-item active">Πάγια έξοδα</li>
            </ol>
                <div class="card mb-4">
                    <a href="/add_expence" class="btn btn-warning" >Προσθήκη Εξόδου</a>    
                </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                        Πίνακας Παγίων εξόδων
                </div>
                <div class="card-body">
                    <table id="expencesTable" class="cell-border display compact">
                        <thead>
                            <tr>
                                <th style="width: 5%">Ημερομηνία</th>
                                <th>Περιγραφή</th>
                                <th style="width: 10%">Ποσό</th>
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Ημερομηνία</th>
                                <th>Περιγραφή</th>
                                <th>Ποσό</th>
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        @forelse ($expences as $expence)
                            <tr>
                                <td>{{ $expence->expence_date->format('d-m-Y') }}</td>
                                <td>{{ $expence->description }}</td>
                                <td>{{ number_format($expence->amount,2,",",".") }} €</td>
                                <td style="width:15%" >
                                    <div class="d-flex justify-content-evenly">
                                        <a href="/edit_expence/{{ $expence->id }}" class="btn btn-sm btn-warning flex-fill">
                                            <i class="far fa-edit"></i>Edit</a>
                                            <form action="/expences/{{ $expence->id }}" id="deleteForm" method="POST">
                                            @method('DELETE')
                                            @csrf
                                                <button class="btn btn-sm btn-danger show_confirm"><i class="far fa-trash-alt"></i></button>
                                            </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            Δεν υπάρχουν καταχωρημένα πάγια έξοδα στην βάση δεδομένων.
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"type="text/javascript"></script>
    <script type="text/javascript" src="https:////cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.11/sorting/date-eu.js"></script>
    <script type = "text/javascript">
        $(document).ready( function () {$('#expencesTable').DataTable({
            order: [[0,'desc']],
            columnDefs: [{ 
                type: 'date-eu', targets: [0], 
                
                }]} 
        );});
        </script>
    
@endsection