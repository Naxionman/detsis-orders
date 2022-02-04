@extends('template')

@section('title', 'Επεξεργασία προϊόντος')

@section('content')
<div class="container">
    <div class="card bg-info bg-opacity-50 shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 "><i class="fas fa-box-open"></i>Επεξεργασία στοιχείων προϊόντος</h3></div>
            <div class="card-body bg-light">
                <form action="/edit_product/{{ $product->id }}" id="editProduct" method="POST">
                    <div class="row">
                        <div class="col-8">
                            @method('PATCH')
                            <div class="row mt-3 justify-content-center">
                                <div class="col-sm-4"><label for="inputDetsisCode">Κωδικός μας (DCode)</label></div>
                                <div class="col-sm-4"><input class="form-control" value="{{ $product->detsis_code }}" type="text" id="inputDetsisCode" name="detsis_code"  required="required" autofocus></div>
                            </div>
                            <div class="row mt-3 justify-content-center">
                                <div class="col-sm-4"><label for="inputSupplierCode">Κωδικός προμηθευτή</label></div>
                                <div class="col-sm-4"><input class="form-control" value="{{ $product->product_code }}" type="text" id="inputSupplierCode" name="product_code"></div>
                            </div>
                            
                            <div class="row mt-3 justify-content-center">
                                <div class="col-sm-4"><label for="inputProductName">Ονομασία προϊόντος</label></div>
                                <div class="col-sm-4"><input class="form-control" value="{{ $product->product_name }}" type="text" id="inputProductName" name="product_name"></div>
                            </div>
                            
                            <div class="row mt-3 justify-content-center">
                                <div class="col-sm-4"><label for="inputStockLevel">Ποσότητα Αποθήκης</label></div>
                                <div class="col-sm-4"><input class="form-control" value="{{ $product->stock_level }}" type="number" id="inputStockLevel" name="stock_level"></div>
                            </div>
                            <div class="row mt-3 justify-content-center">
                                <div class="col-sm-4"><label for="inputMinLevel">Όριο ποσότητας</label></div>
                                <div class="col-sm-4"><input class="form-control" value="{{ $product->min_level }}" type="number" id="inputMinLevel" name="min_level"></div>
                            </div>
                            <div class="row mt-3 justify-content-center">
                                <div class="col-sm-2"><label class="form-label" for="inputUrl">Url εικόνας</label></div>
                                <div class="col-sm-7"><input class="form-control" value="{{ $product->image_url }}" type="file" id="inputUrl" name="image_url"></div>
                                <div class="col-sm-1">
                                    <i data-toggle="tooltip" data-placement="top" title="Οι εικόνες πρέπει να είναι διαστάσεων 256x256 και να βρίσκονται στον φάκελο PRODUCTS. 
                                    Μόλις καταχωρηθεί επιτυχώς μία εικόνα αντιγράφεται αυτόματα στον εσωτερικό φάκελο της εφαρμογής " class="far fa-question-circle align-middle" style="color:#8fade0;"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 justify-content-center">
                            <div class="row">
                                Εικόνα προϊόντος
                            </div>

                            <div class="row">
                                @if($product->image_url == null)
                                    <img class="shadow-lg p-0" src="/images/products/no_image.png" style="border-radius: 30px; width: 256px; height: 256px;">
                                @else
                                    <img class="shadow-lg p-0" src="/images/products/{{ $product->image_url }}" style="border-radius: 30px; width: 256px; height: 256px;">
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputNotes">Σημειώσεις</label>
                            <textarea class="form-control" name="notes" type="text" id="inputNotes" rows="3">{{ $product->notes }}</textarea>
                          </div>
                        </div>
                        
                        @csrf
                    </div>
                </form>
            <div class="card-footer text-center py-2">
                <button class="btn btn-danger shadow-sm" type="submit" form="editProduct">  Αποθήκευση  </button>
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

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
</div>
@endsection