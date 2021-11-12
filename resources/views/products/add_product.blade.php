@extends('template')

@section('title', 'Προσθήκη προϊόντος')

@section('content')
<div class="container">
    <div class="card bg-info bg-opacity-25 shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 "><i class="fas fa-box-open"></i>    Νέο προϊόν</h3></div>
            <div class="card-body bg-light">
                <form action="add_product" id="addProduct" method="POST">
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputDetsisCode">Κωδικός μας (DCode)</label></div>
                        <div class="col-sm-4"><input class="form-control" autocomplete="nope" type="text" id="inputDetsisCode" name="detsis_code" placeholder="Κωδικός εργοστασίου μας"  required="required" autofocus></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputSupplierCode">Κωδικός προμηθευτή</label></div>
                        <div class="col-sm-4"><input class="form-control" autocomplete="nope" type="text" id="inputSupplierCode" name="product_code" placeholder="Κωδικός από τον προμηθευτή"></div>
                    </div>
                    
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputProductName">Ονομασία προϊόντος</label></div>
                        <div class="col-sm-4"><input class="form-control" autocomplete="nope" type="text" id="inputProductName" name="product_name" placeholder="Ονομασία"></div>
                    </div>
                    
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputStockLevel">Ποσότητα Αποθήκης</label></div>
                        <div class="col-sm-4"><input class="form-control" autocomplete="nope" type="number" id="inputStockLevel" name="stock_level" placeholder="Stock"></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputMinLevel">Όριο ποσότητας</label></div>
                        <div class="col-sm-4"><input class="form-control" autocomplete="nope" type="number" id="inputMinLevel" name="min_level" placeholder="Ελάχιστη ποσότητα"></div>
                    </div>
                    @csrf
                </form>
            </div>
            <div class="card-footer text-center py-2">
                <button class="btn btn-danger" type="submit" form="addProduct">  Αποθήκευση  </button>
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
@endsection