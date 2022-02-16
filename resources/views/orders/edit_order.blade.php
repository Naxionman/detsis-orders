@extends('template')

@section('title', 'Επεξεργασία παραγγελίας - Detsis Orders')

@section('content')

<div class="container">
    <div class="card bg-success bg-opacity-50 shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 ">Παραγγελία : {{ $order->id }}</h3></div>
            <div class="card-body bg-light">
                <form action="/edit_order/{{ $order->id }}" id="editOrder" method="POST">
                    @method('PATCH')
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputOrderDate">Ημερομηνία</label></div>
                        <div class="col-sm-4"><input class="form-control" type="date" id="inputOrderDate" value="{{ $order->order_date->format('Y-m-d') }}" name="order_date" required="required" autofocus></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputSupplier">Προμηθευτής</label></div>
                        <div class="col-sm-4">
                            <select class="js-example-basic-single form-control" id="inputSupplier" name="supplier_id">
                                <option value="{{ $order->supplier_id}}" selected>{{ $order->supplier->company_name }}</option>
                                @foreach ($suppliers as $supplier)
                                    <option   type="text" value="{{ $supplier->id }}">{{ $supplier->company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-2"><label for="inputClient">Πελάτης (προαιρετικό)</label></div>
                        <div class="col-4">
                            <select class="js-example-basic-single form-control" id="inputClient" name="client_id">
                                <option value="{{ $order->client_id }}">{{ $order->client->surname }} {{ $order->client->name }}</option>
                                <option value="1">Δεν αφορά πελάτη</option>
                                    @foreach ($clients as $client)
                                        <option type="text" value="{{ $client->id }}">{{ $client->surname }} {{ $client->name }}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-2"><label for="inputPending">Έχει έρθει;</label></div>
                        <div class="col-4">
                            <input type="hidden" name="pending" value="1">
                            @if ($order->pending == 1)
                                <div class="form-check form-switch"><input class="form-check-input" type="checkbox" value="1" name="pending" id="inputPending" unchecked></div>
                                
                            @else
                                <div class="form-check form-switch"><input class="form-check-input" type="checkbox" value="0" name="pending" id="inputPending" checked></div>
                            @endif
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
                                @php
                                    $i=1;
                                @endphp
                                @foreach ($details as $detail)
                                <tr id="trToPlace">
                                    <td style="width:5%"> {{  $i }}</td>
                                    <td style="width:5%"><input class="form-control" type="number" name="quantity{{ $i }}" value="1" required="required"></td>
                                    <td>
                                        <select class="form-control js-example-basic-single" name="product{{ $i }}" id="product{{ $i }}">
                                            <option value="{{ $detail->product->id }}" selected>{{ $detail->product->product_name}} ({{ $detail->product->detsis_code }})</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->product_name }} ({{ $product->detsis_code }})</option>
                                                @endforeach
                                        </select>
                                    </td>
                                    <td style="width:10%">
                                        <button type="button" id="addProduct" onclick="addInputField({{ $i }})" class="btn btn-warning btn-sm m-1"> + </button>
                                        <button type="button" id="removeProduct" onclick="removeInputField({{ $i }})" class="btn btn-danger btn-sm m-1"> - </button></td><input type="hidden" name="count" value="{{ $i}}">
                                    </td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <div class="col-sm-4">
                        </div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputNotes">Σημειώσεις</label></div>
                        <div class="col-sm-4"><textarea rows="4" class="form-control" autocomplete="nope" type="text" id="inputNotes" name="notes" value="{{ $order->notes }}">{{ $order->notes }}</textarea></div>
                    </div>
                    
                    @csrf
                </form>
            </div>
            <div class="card-footer text-center py-2">
                <button class="btn btn-danger shadow-sm" type="submit" form="editOrder">  Αποθήκευση  </button>
                <a href="javascript:history.back()" class="btn btn-info shadow-sm">  Ακύρωση - Επιστροφή </a>
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
</div>

<script type="text/javascript">
    $('#product1').select2();
    function addInputField(count){
        var count;
        count = count +1;
        var fragment = document.createElement('tr');
        fragment.id = 'fragment'+count;
        var oldButton = document.getElementById('addProduct');
        oldButton.parentNode. removeChild(oldButton);
        fragment.innerHTML = '<td style="width:5%">{{$i++}}</td><td style="width:5%"><input class="form-control" value="1" type="number" name="quantity'+count+'" required="required"></td><td><select class="form-control js-example-basic-single" id="fragment'+count+'" name="product'+count+'">@foreach($products as $product)<option value="{{ $product->id }}">{{ $product->product_name }} ({{$product->detsis_code}})</option>@endforeach </select></td><td style="width:10%"><button type="button" id="addProduct" onclick="addInputField('+count+')" class="btn btn-warning btn-sm m-1"> + </button><button type="button" id="removeProduct" onclick="removeInputField('+count+')" class="btn btn-danger btn-sm m-1"> - </button></td><input type="hidden" name="count" value="'+count+'">';
        document.getElementById('tableBody').appendChild(fragment);
        $('.js-example-basic-single').select2();
    }
 
    function removeInputField(count){
        var fragmentToRemove = document.getElementById('fragment'+count);
        var oldButton = document.createElement('td');
        fragmentToRemove.parentNode.removeChild(fragmentToRemove);
        if($('[id^=addProduct]').length < 1){
            var oldButton = document.createElement('td');
            oldButton.innerHTML = '<button type="button" id="addProduct" onclick="addInputField('+count+')" class="btn btn-warning btn-sm m-1"> + </button>';
            document.getElementById('trToPlace'). appendChild(oldButton);
        }
    }
</script>
@endsection




