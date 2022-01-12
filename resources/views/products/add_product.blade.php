@extends('template')

@section('title', 'Προσθήκη προϊόντος')

@section('content')
<div class="container">
    <div class="card bg-info bg-opacity-25 shadow-sm border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 "><i class="fas fa-box-open"></i>    Νέο προϊόν</h3></div>
            <div class="card-body bg-light">
                <div class="row">
                    <div class="col-8">
                        <form action="add_product" id="addProduct" method="POST">
                            <div class="row mt-3 justify-content-center">
                                <div class="col-sm-4"><label for="inputDetsisCode">Κωδικός μας (DCode)</label></div>
                                <div class="col-sm-4"><input class="form-control" autocomplete="off" type="text" id="inputDetsisCode" name="detsis_code" placeholder="Κωδικός εργοστασίου μας"  required="required" autofocus></div>
                            </div>
                            <div class="row mt-3 justify-content-center">
                                <div class="col-sm-4"><label for="inputSupplierCode">Κωδικός προμηθευτή</label></div>
                                <div class="col-sm-4"><input class="form-control" autocomplete="nope" type="text" id="inputSupplierCode" name="product_code" placeholder="Κωδικός από τον προμηθευτή"></div>
                            </div>
                            
                            <div class="row mt-3 justify-content-center">
                                <div class="col-sm-4"><label for="inputProductName">Ονομασία προϊόντος</label></div>
                                <div class="col-sm-4"><input class="form-control" autocomplete="nope" type="text" id="inputProductName" name="product_name" placeholder="Ονομασία"></div>
                            </div>
                            
                            <div class="row mt-3 justify-content-center">
                                <div class="col-sm-4"><label for="inputStockLevel">Ποσότητα Αποθήκης</label></div>
                                <div class="col-sm-4"><input class="form-control" autocomplete="nope" type="number" id="inputStockLevel" name="stock_level" placeholder="Stock"></div>
                            </div>
                            <div class="row mt-3 justify-content-center">
                                <div class="col-sm-4"><label for="inputMinLevel">Όριο ποσότητας</label></div>
                                <div class="col-sm-4"><input class="form-control" autocomplete="nope" type="number" id="inputMinLevel" name="min_level" placeholder="Ελάχιστη ποσότητα"></div>
                            </div>
                            <div class="row mt-3 justify-content-center">
                                <div class="col-sm-2"><label class="form-label" for="inputUrl">Url εικόνας</label></div>
                                <div class="col-sm-8"><input class="form-control" type="file" id="inputUrl"></div>
                            </div>
                            <div class="form-group">
                                <label for="inputNotes">Σημειώσεις</label>
                                <textarea class="form-control" name="notes" id="inputNotes" rows="3"></textarea>
                              </div>
                            @csrf
                        </form>
                    </div>
                    <div class="col-4 justify-content-center">
                        <div class="row">
                            Κατηγορία προϊόντος:
                        </div>
                        <div class="row">
                            <label for="category">Κατηγορία :</label>
                            <strong><div id="category"></div></strong>
                        </div>
                        <div class="row">
                            <label for="subCategory">Υποκατηγορία :</label>
                            <strong><div id="subCategory"></div></strong>
                        </div>
                        <div class="row">
                            <label for="lastProduct">Τελευταίο προϊόν :</label>
                            <strong><div id="lastProduct"></div></strong>
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <div class="row">
                            <button type="button" class="btn btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#categories">Δες τις κατηγορίες</button>
                            <!-- Modal -->
                            <div class="modal fade" id="categories" tabindex="-1" role="dialog" aria-labelledby="title" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="titleLong">Κατηγορίες Προϊόντων</h5>
                                    
                                    </div>
                                    <div class="modal-body">
                                        @include('products.categories')
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Κλείσιμο</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                </div>
            <div class="card-footer text-center py-2">
                <button class="btn btn-danger shadow-sm" type="submit" form="addProduct">  Αποθήκευση  </button>
                <a href="/products" class="btn btn-info shadow-sm">  Ακύρωση - Επιστροφή </a>
            </div>
        </div>








        <!-- Passing the $codes array to the js file -->
        <script> window.count = '<?php echo json_encode($codes) ?>'; </script>
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