@extends('template')

@section('title', 'Επεξεργασία Πληρωμής')

@section('content')
<div class="container">
    <div class="card bg-warning bg-opacity-25 shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 ">Επεξεργασία πληρωμής</h3></div>
            <div class="card-body bg-light">
                <form action="/edit_payment/{{ $payment->id }}" id="editPayment" method="POST">
                @method('PATCH')
                    <div class="row mt-3 justify-content-center">
                        <div class="col-2">
                            <button class="btn btn-sm" type="button">
                                <img id="bank1icon" class="shadow-sm" src="\images\bank1.jpg" style="border-radius: 10px; width: 100px; height: 50px;"></div>
                            </button>
                            
                        <div class="col-2">
                            <button class="btn btn-sm" type="button">
                                <img id="bank2icon" class="shadow-sm" src="\images\bank2.jpg" style="border-radius: 10px; width: 100px; height: 50px;"></div>
                            </button>
                        <div class="col-2">
                            <button class="btn btn-sm" type="button">
                                <img id="bank3icon" class="shadow-sm" src="\images\bank3.jpg" style="border-radius: 10px; width: 100px; height: 50px;"></div>
                            </button>
                        <div class="col-2">
                            <button class="btn btn-sm" type="button">
                                <img id="bank4icon" class="shadow-sm" src="\images\bank4.jpg" style="border-radius: 10px; width: 100px; height: 50px;"></div>
                            </button>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputDate">Ημερομηνία Πληρωμής</label></div>
                        <div class="col-sm-4"><input class="form-control" value="{{$payment->payment_date->format("Y-m-d") }}" type="date" id="inputDate" name="payment_date" required="required"></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-2"><label for="inputSupplier">Προμηθευτής</label></div>
                        <div class="col-4">
                            <select class="js-example-basic-single form-control" id="inputSupplier" name="supplier_id">
                                <option value="{{ $payment->supplier_id }}" selected>{{ $payment->supplier->company_name }}</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputHolder">Δικαιούχος</label></div>
                        <div class="col-sm-4"><input class="form-control" value="{{ $payment->holder }}" type="text" id="inputHolder" name="holder"></div>
                    </div>    
                    <div class="row mt-3 justify-content-center">
                        <div class="col-2"><label for="inputBank">Τράπεζα</label></div>
                        <div class="col-4">
                            <select class="form-control" autocomplete="nope" type="text" id="inputBank" name="bank" required="required" >
                                <option value="{{ $payment->bank }}" selected>{{ $payment->bank }}</option>
                                <option style="background-image:url(bank1.jpg);" value="Τράπεζα Πειραιώς">Τράπεζα Πειραιώς</option>
                                <option value="Εθνική Τράπεζα">Εθνική Τράπεζα</option>
                                <option value="Eurobank">Eurobank</option>
                                <option value="Alpha Bank">Alpha Bank</option>
                                <option value="Μετρητά">Μετρητά</option>
                            </select>
                        </div>
                    </div>
     
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputAmount">Ποσόν</label></div>
                        <div class="col-sm-4"><input class="form-control" value="{{ $payment->amount }}" type="number" step="0.01" id="inputAmount" name="amount"></div>
                    </div>    
                    @csrf
                </form>
            </div>
            <div class="card-footer text-center py-2">
                <button class="btn btn-danger shadow-sm" type="submit" form="editPayment">  Αποθήκευση Αλλαγών </button>
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