@extends ('template')

@section('title', 'Ημερήσια κίνηση οχημάτων')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Κινήσεις</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/">Αρχική σελίδα</a></li>
                <li class="breadcrumb-item active">Κινήσεις</li>
            </ol>
                <div class="card mb-4">
                    <a href="/add_dispatch" class="btn btn-warning" >Προσθήκη Κίνησης</a>    
                </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-car me-1"></i>
                        Ημερολόγιο κινήσεων
                </div>
                <div class="card-body">
                    <table id="myTable" class="cell-border display compact">
                        <thead>
                            <tr>
                                <th>Ημερομηνία</th>
                                <th>Όχημα</th>
                                <th>Πελάτης</th>
                                <th>Πλήρωμα</th>
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Ημερομηνία</th>
                                <th>Όχημα</th>
                                <th>Πελάτης</th>
                                <th>Πλήρωμα</th>
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        @forelse ($dispatches as $dispatch)
                            <tr>
                                <td><strong>{{ $dispatch->dispatch_date->format('d-m-Y') }}</strong></td>                                
                                <td>{{ $dispatch->vehicle->name }}</td>
                                <td>{{ $dispatch->client }}</td>
                                <td>@foreach ($dispatch->employees as $employee)
                                    {{ $employee->surname }},
                                @endforeach</td>
                                <td style="width:15%" >
                                    <div class="d-flex justify-content-evenly">
                                        <a href="/edit_dispatch/{{ $dispatch->id }}" class="btn btn-warning flex-fill">
                                            <i class="far fa-edit"></i>Edit</a>
                                            <form action="/edit_dispatch/{{ $dispatch->id }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                                <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                            </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <strong> Δεν υπάρχουν καταχωρημένες κινήσεις στην βάση δεδομένων.</strong>
                            <hr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
@endsection