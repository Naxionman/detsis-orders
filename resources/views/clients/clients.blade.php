@extends ('template')

@section('title', 'Πελάτες')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Πελάτες</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/">Αρχική σελίδα</a></li>
                <li class="breadcrumb-item active">Πελάτες</li>
            </ol>
                <div class="card mb-4">
                    <a href="/add_client" class="btn btn-warning" >Προσθήκη Πελάτη</a>    
                </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                        Πίνακας πελατών
                </div>
                <div class="card-body">
                    <table id="clientsTable" class="cell-border display compact">
                        <thead>
                            <tr >
                                <th>Επώνυμο</th>
                                <th>Όνομα</th>
                                <th>Κινητό</th>
                                <th>Άλλο</th>
                                <th>email</th>
                                <th>Ε/Δ</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Επώνυμο</th>
                                <th>Όνομα</th>
                                <th>Κινητό</th>
                                <th>Άλλο</th>
                                <th>email</th>
                                <th>Ε/Δ</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        @forelse ($clients as $client)
                            <tr data-href="view_client/{{ $client->id }}">     
                                <td><strong>{{$client->surname }}</strong></td>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->mobile }}</td>
                                <td>{{ $client->phone2 }}</td>
                                <td>{{ $client->email }} 
                                    <a href="https://compose.mail.yahoo.com/?to="><i class="fab fa-yahoo"></i></a>
                                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $client->email }}"><i class="fab fa-google"></i></a>
                                </td>
                                <td style="width:5%" >
                                    <!-- Experimental new style control elements -->
                                    <div class="btn-group dropstart stop-propagation">
                                        <button type="button" class="btn btn-light" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="defaultDropdown">
                                            <!-- Dropdown menu links -->
                                            <li><a class="dropdown-item" href="/edit_client/{{ $client->id }}">Επεξεργασία</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><form action="/clients/{{ $client->id }}" id="deleteForm{{ $client->id }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="dropdown-item show_confirm">Διαγραφή</button>
                                            </form></li>
                                        
                                        </ul>
                                    <style>
                                        .dropdown-toggle::after {
                                            content: none;
                                        }
                                    </style>
                                    </div>
                                    
                                    
                                    
                                    
                                <!--
                                    <div class="d-flex justify-content-evenly">
                                        <a href="/edit_client/{{ $client->id }}" class="btn btn-sm btn-warning flex-fill">
                                            <i class="far fa-edit"></i>Edit</a>
                                            <form action="/clients/{{ $client->id }}" id="deleteForm" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="button" class="btn btn-danger show_confirm"><i class="far fa-trash-alt"></i></button>
                                            </form>
                                    </div>
                                -->
                                </td>
                            </tr>
                        @empty
                            <strong> Δεν υπάρχουν καταχωρημένοι πελάτες στην βάση δεδομένων.</strong>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"type="text/javascript"></script>
    <script type="text/javascript" src="https:////cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.11/sorting/date-eu.js"></script>
    <script type = "text/javascript">$(document).ready( function () {$('#clientsTable').DataTable();});</script>
    
    <script>
        
    </script>
@endsection