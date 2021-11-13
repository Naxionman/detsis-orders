@extends('template')

@section('title', 'Νέα παραγγελία - Detsis Orders')

@section('content')
<div class="container">
    <div class="card bg-success bg-opacity-75 shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 ">Νέα Παραγγελία</h3></div>
            <div class="card-body bg-light">
                <form action="add_order" id="addOrder" method="POST">
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputOrderDate">Ημερομηνία</label></div>
                        <div class="col-sm-4"><input class="form-control" autocomplete="nope" type="date" id="inputOrderDate" name="order_date" required="required" autofocus></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputSupplier">Προμηθευτής</label></div>
                        <div class="col-sm-4">
                            <select class="form-control" id="inputSupplier" name="supplier_id">
                                @forelse ($suppliers as $supplier)
                                    <option   type="text" value="{{ $supplier->id }}">{{ $supplier->company_name }}</option>
                                @empty
                                    <option>Δεν υπάρχουν προμηθευτές στην βάση!</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3 justify-content-center">
                        <h2>Προϊόντα παραγγελίας</h2>
                        <table id="order" class="cell-border display compact">
                            <thead>
                                <tr>
                                    <th>α/α</th>
                                    <th>Τεμάχια</th>
                                    <th>Ονομασία προϊόντος</th>
                                    <th>Προσθήκη</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <tr>
                                    <td style="width:5%">1</td>
                                    <td style="width:5%"><input class="form-control" type="number" name="quantity0" required="required"></td>
                                    <td><input type="text" class="form-control"  name="product0" list="inputProduct">
                                        <datalist id="inputProduct">
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                            @endforeach
                                        </datalist>
                                    </td>
                                    <td style="width:10%"><button type="button" id="addProduct" onclick="addInputField(0)" class="btn btn-warning btn-sm m-1"> + </button>
                                    </td>
                                </tr>
                                <input type="hidden" name="pending" value="1">
                                
                            </tbody>
                        </table>

                        <div class="col-sm-4">
                            
                            
                        </div>
                    </div>




                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputNotes">Σημειώσεις</label></div>
                        <div class="col-sm-4"><textarea rows="4" class="form-control" autocomplete="nope" type="text" id="inputNotes" name="notes" placeholder="Τα πεδία ημερομηνία άφιξης, μεταφορική εταιρεία, τιμή, έκπτωση και τιμολόγιο φορτωτικής συμπληρώνονται με την παραλαβή" ></textarea></div>
                    </div>

                    
                    
                    @csrf
                </form>
            </div>
            <div class="card-footer text-center py-2">
                <button class="btn btn-danger" type="submit" form="addOrder">  Αποθήκευση  </button>
            </div>
        </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <audio autoplay src="/sound/beep.mp3"/>
    @endif

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
</div>

<script type="text/javascript">
    function addInputField(count){
        var count;
        count = count +1;
        var fragment = document.createElement('tr');

        fragment.innerHTML = '<td style="width:5%">'+(count+1)+'</td><td style="width:5%"><input class="form-control" type="number"name="quantity'+count+'" required="required"></td><td><input type="text" class="form-control"  name="product'+count+'" list="inputProduct"><datalist id="inputProduct">@foreach ($products as $product)<option value="{{ $product->id }}">{{ $product->product_name }}</option>@endforeach</datalist></td><td style="width:10%"><button type="button" id="addProduct" onclick="addInputField('+count+')" class="btn btn-warning btn-sm m-1"> + </button><button type="button" id="removeProduct" onclick="removeInputField(0)" class="btn btn-danger btn-sm m-1"> - </button></td><input type="hidden" name="count" value="'+count+'">';

        document.getElementById('tableBody').appendChild(fragment);
    }

    function removeInputField(){
        
    }
</script>

@endsection


