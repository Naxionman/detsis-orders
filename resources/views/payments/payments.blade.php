@extends ('template')

@section('title', 'Πληρωμές')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Πληρωμές</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/">Αρχική σελίδα</a></li>
                <li class="breadcrumb-item active">Πληρωμές</li>
            </ol>
                <div class="card mb-4">
                    <a href="/add_payment" class="btn btn-success" style="background-color: rgb(19, 175, 79)" >Νέα πληρωμή</a>    
                </div>
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-5">
                            <i class="fas fa-table me-1"></i>Πίνακας πληρωμών
                        </div>
                        <div class="form-check form-switch col">
                            <label class="form-check-label" for="switchShowroom">Μόνο Εμπορίου</label>
                            <input class="form-check-input" type="checkbox" id="switchShowroom">
                        </div>
                        <div class="form-check form-switch col">
                            <label class="form-check-label" for="switchFactory">Μόνο Εργοστασίου</label>
                            <input class="form-check-input" type="checkbox" id="switchFactory">
                        </div>    
                    </div>
                    
                </div>
                <div class="card-body">
                    <table id="paymentsTable" class="cell-border display compact">
                        <thead>
                            <tr>
                                <th style="width: 5%">Ημερομηνία</th>
                                <th style="width: 35%">Προμηθευτής</th>
                                <th style="width: 15%">Τράπεζα</th>
                                <th style="width: 35%">Δικαιούχος</th>
                                <th style="width: 10%">Ποσόν</th>
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Ημερομηνία</th>
                                <th>Προμηθευτής</th>
                                <th>Τράπεζα</th>
                                <th>Δικαιούχος</th>
                                <th>Ποσόν</th>
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        @forelse ($payments as $payment)
                            <tr data-href="view_payment/{{ $payment->id}}">
                                <td>{{$payment->payment_date->format('d-m-Y') }}</td>
                                <td>{{ $payment->supplier->company_name }}</td>
                                <td>{{$payment->bank }}</td>
                                <td>{{$payment->holder }}</td>
                                <td class="text-end pe-3">{{number_format($payment->amount, 2, ",",".") }} €</td>
                                <td style="width:5%" >
                                    <div class="btn-group dropstart ">
                                        <button type="button" class="btn btn-light stop-propagation" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="defaultDropdown">
                                            <!-- Dropdown menu links -->
                                            <li><a class="dropdown-item"  href="/edit_payment/{{ $payment->id }}">Επεξεργασία</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><form action="/payments/{{ $payment->id }}" id="deleteForm{{ $payment->id }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="dropdown-item show_confirm">Διαγραφή</button>
                                            </form></li>
                                        
                                        </ul>
                                    </div>

                                    <!-- Old edit+delete
                                    <div class="d-flex justify-content-evenly">
                                        <a href="/edit_payment/{{ $payment->id }}" class="btn btn-sm btn-warning ">
                                            <i class="far fa-edit"></i>Edit</a>
                                            <form action="/payments/{{ $payment->id }}" id="deleteForm" method="POST">
                                            @method('DELETE')
                                            @csrf
                                                <button type="button" class="btn btn-sm btn-danger show_confirm"><i class="far fa-trash-alt"></i></button>
                                            </form>
                                    </div>
                                    -->
                                </td>
                            </tr>
                        @empty
                            No payments added in the database.
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
    </div>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"type="text/javascript"></script>
    <script type="text/javascript" src="https:////cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.11/sorting/date-eu.js"></script>
    <script type = "text/javascript">$(document).ready( function () {$('#paymentsTable').DataTable({
        order: [0,'desc'],
        columnDefs: [{ 
            type: 'date-eu', targets: [0] 
        }]}  
        );});</script>
@endsection