@extends('template')

@section('title', 'Προσθήκη πληρωμής - Detsis Orders')

@section('content')
<div class="container">
    <div class="card shadow-sm border-0 rounded-3 mt-3 " style="background-color: #FFD700">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 ">Νέα πληρωμή</h3></div>
            <div class="card-body bg-light">
                <form action="add_payment" id="addPayment" method="POST">
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
                        <div class="col-2"><label for="inputDate">Ημερομηνία πληρωμής</label></div>
                        <div class="col-4"><input class="form-control" type="date" value="{{ date('Y-m-d') }}" id="inputDate" name="payment_date"></div>
                    </div>
                    
                    
                    <div class="row mt-3 justify-content-center">
                        <div class="col-2"><label for="inputSupplier">Προμηθευτής</label></div>
                        <div class="col-4">
                            <select class="js-example-basic-single form-control" id="inputSupplier" name="supplier_id" required="required">
                                @foreach ($suppliers as $supplier)
                                    <option   type="text" value="{{ $supplier->id }}">{{ $supplier->company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-2"><label for="inputHolder">Δικαιούχος</label></div>
                        <div class="col-4"><input class="form-control" type="text" id="inputHolder" name="holder" placeholder="Δικαιούχος λογαριασμού" required="required"></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-2"><label for="inputBank">Τράπεζα</label></div>
                        <div class="col-4">
                            <select class="form-control" autocomplete="nope" type="text" id="inputBank" name="bank" required="required" >
                                <option style="background-image:url(bank1.jpg);" value="Τράπεζα Πειραιώς">Τράπεζα Πειραιώς</option>
                                <option value="Εθνική Τράπεζα">Εθνική Τράπεζα</option>
                                <option value="Eurobank">Eurobank</option>
                                <option value="Alpha Bank">Alpha Bank</option>
                                <option value="Μετρητά">Μετρητά</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputAmount" required="required">Ποσόν (€)</label></div>
                        <div class="col-sm-4"><input class="form-control" autocomplete="nope" type="number" step="0.01" id="inputAmount" name="amount" ></div>
                    </div>
                    @csrf
                </form>
            </div>
            <div class="card-footer text-center py-2">
                <button class="btn btn-danger shadow-sm" type="submit" form="addPayment">  Αποθήκευση  </button>
                <a href="/payments" class="btn btn-info shadow-sm">  Ακύρωση - Επιστροφή </a>
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