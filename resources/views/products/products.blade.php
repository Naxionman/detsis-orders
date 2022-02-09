@extends ('template')

@section('title', 'Προϊόντα')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Προϊόντα</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/">Αρχική σελίδα</a></li>
                <li class="breadcrumb-item active">Προϊόντα</li>
            </ol>
                <div class="card mb-4 shadow-sm">
                    <a href="/add_product" class="btn btn-info bg-info bg-opacity-25" >Προσθήκη προϊόντος</a>    
                </div>
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-4">
                            <i class="fas fa-table me-1"></i>Προϊόντα
                        </div>
                        <div class="col-8">Επιλογές προβολής 
                            <button class="btn btn-sm shadow-sm"><i class="fas fa-th-list"></i></button>
                            <button class="btn btn-sm shadow-sm"><i class="fas fa-th"></i></button>
                            <button class="btn btn-sm shadow-sm"><i class="fas fa-th-large"></i></button>
                        </div>
                        
                    </div>
                    
                </div>
                <div class="card-body">
                    <table id="productsTable" class="cell-border display compact">
                        <thead>
                            <tr>
                                <th>DCode</th>
                                <th>SupCode</th>
                                <th>Εικόνα</th>
                                <th>Ονομασία προϊόντος</th>
                                <th><strong>Ποσότητα</strong> </th>
                                <th>Όριο</th>
                                <th>Προμηθευτής</th>
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>DCode</th>
                                <th>SupCode</th>
                                <th>Εικόνα</th>
                                <th>Ονομασία προϊόντος</th>
                                <th><strong>Ποσότητα</strong> </th>
                                <th>Όριο</th>
                                <th>Προμηθευτής</th>
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        @forelse ($products as $product)
                            <tr data-href="view_product/{{ $product->id}}">
                                <td><strong>{{$product->detsis_code }}</strong></td>
                                <td>{{$product->product_code }}</td>
                                <td>
                                    @if ($product->image_url != null)
                                    <img src="images/products/{{ $product->image_url }}" width="50px" height="50px" >
                                    @else
                                    <img src="images/products/no_image.png" width="50px" height="50px" >
                                    @endif
                                </td>
                                <td>{{$product->product_name }}</td>
                                <td>{{$product->stock_level }}</td>
                                <td>{{$product->min_level }}</td>
                                <td>{{$product->last_supplier }}</td>
                                <td style="width:15%" >
                                    <div class="d-flex justify-content-evenly">
                                        <a href="/edit_product/{{ $product->id }}" class="btn btn-sm btn-warning flex-fill">
                                            <i class="far fa-edit"></i>Edit</a>
                                            <form action="/products/{{ $product->id }}" id="deleteForm" method="POST">
                                            @method('DELETE')
                                            @csrf
                                                <button class="btn btn-sm btn-danger show_confirm"><i class="far fa-trash-alt"></i></button>
                                            </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            No products added in the database.
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"type="text/javascript"></script>
    <script type="text/javascript" src="https:////cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.11/sorting/date-eu.js"></script>
    <script type = "text/javascript">$(document).ready( function () {$('#productsTable').DataTable();});</script>
    
@endsection