@extends ('template')

@section('title', 'Προμηθευτές')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Προμηθευτές</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/">Αρχική σελίδα</a></li>
                <li class="breadcrumb-item active">Προμηθευτές</li>
            </ol>
                <div class="card mb-4">
                    <a href="/add_supplier" class="btn btn-success" >Προσθήκη προμηθευτή</a>    
                </div>
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-5">
                            <i class="fas fa-table me-1"></i>Πίνακας προμηθευτών
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
                    <table id="suppliersTable" class="cell-border display compact">
                        <thead>
                            <tr>
                                <th>Notes</th>
                                <th>Ονομασία</th>
                                <th>email</th>
                                <th>Τηλέφωνο</th>
                                <th>Τιμολόγια</th>
                                <th>Σε αναμονή</th>
                                <th>Σύνολο €</th>
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Notes</th>
                                <th>Ονομασία</th>
                                <th>email</th>
                                <th>Τηλέφωνο</th>
                                <th>Τιμολόγια</th>
                                <th>Σε αναμονή</th>
                                <th>Σύνολο €</th>
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        @forelse ($suppliers as $supplier)
                            <tr data-href="view_supplier/{{ $supplier->id}}">
                                <td>{{ $supplier->description }}</td>
                                <td><strong>{{$supplier->company_name }}</strong></td>
                                <td>{{ $supplier->email }}</td>
                                <td>{{ $supplier->phone1 }}</td>
                                <td>{{ $invoices->where('supplier_id','=',$supplier->id)->count() }}</td>
                                <td>{{ $orders->where('supplier_id','=',$supplier->id)->where('pending','=','1')->count() }}</td>
                                <td>
                                    @php
                                        //The array of payments made to this supplier
                                        $paid = $payments->where('supplier_id','=',$supplier->id)->sum('amount');
                                        //dd($paid);   
                                        $sum_charged = $invoices->where('supplier_id','=',$supplier->id)->sum('invoice_total');        
                                        //The balance = invoice charges - payments + initial balance 
                                        $new_balance = round($sum_charged - $paid + $supplier->starting_balance,2);
                                    @endphp
                                        {{ $new_balance }}
                                    €</td>
                                <td style="width:5%" >
                                    <div class="btn-group dropstart ">
                                        <button type="button" class="btn btn-light stop-propagation" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="defaultDropdown">
                                            <!-- Dropdown menu links -->
                                            <li><a class="dropdown-item" href="/edit_supplier/{{ $supplier->id }}">Επεξεργασία</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><form action="/suppliers/{{ $supplier->id }}" id="deleteForm{{ $supplier->id }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="dropdown-item show_confirm">Διαγραφή</button>
                                            </form></li>
                                        
                                        </ul>
                                    </div>

                                    <!-- OLD edit+delete
                                    <div class="d-flex justify-content-evenly">
                                        <a href="/edit_supplier/{{ $supplier->id }}" class="btn btn-warning btn-sm">
                                            <i class="far fa-edit"></i>Edit</a>
                                            <form action="/suppliers/{{ $supplier->id }}" id="deleteForm" method="POST">
                                            @method('DELETE')
                                            @csrf
                                                <button class="btn btn-sm btn-danger show_confirm"><i class="far fa-trash-alt"></i></button>
                                            </form>
                                    </div>
                                    -->
                                </td>
                            </tr>
                        @empty
                            No suppliers added in the database.
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
<script>
    $(document).ready( function () {
        $('#suppliersTable').DataTable({
            columnDefs: [{
                targets: 0,
                searchable: true,
                visible: false
            }]
          });
    });
</script>
@endsection