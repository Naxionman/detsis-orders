@extends('template')

@section('title', 'Στοιχεία προμηθευτή')

@section('content')
<div class="container">
    <div class="card bg-success  bg-gradient shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 ">{{$supplier->company_name}}</h3></div>
            <div class="card-body bg-light">
                    <div class="row mt-3 justify-content-center">
                        <div class="col">
                            <div class="row">
                                <div class="col-4"><label>Ονομασία Εταιρείας</label></div>
                                <div class="col-8"><strong>{{$supplier->company_name}}</strong></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><label>Πωλητής/Εκπρόσωπος</label></div>
                                <div class="col-8"><strong>{{$supplier->salesman ?: '-'}}</strong></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><label>Ιστοσελίδα</label></div>
                                <div class="col-8"><a href="{{ $supplier->website }}" target="_blank">{{ $supplier->website }}</a></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><label>E-mail</label></div>
                                <div class="col-8"><a style="color: rgb(131, 173, 52)" href="https://compose.mail.yahoo.com/?to={{ $supplier->email }}" target="_blank">{{ $supplier->email }}</a></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><label>Τηλέφωνο 1</label></div>
                                <div class="col-8"><strong>{{$supplier->phone1 ?: '-'}}</strong></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><label>Τηλέφωνο 2</label></div>
                                <div class="col-8"><strong>{{$supplier->phone2 ?: '-'}}</strong></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><label>Διεύθυνση</label></div>
                                <div class="col-8">{{$supplier->address ?: '-'}}</div>
                            </div>
                            <div class="row">
                                <div class="col-4"><label>T.K.</label></div>
                                <div class="col-8">{{$supplier->zipcode ?: '-'}}</div>
                            </div>
                            <div class="row">
                                <div class="col-4"><label>Πόλη</label></div>
                                <div class="col-8">{{$supplier->city ?: '-'}}</div>
                            </div>
                            <div class="row">
                                <div class="col-4"><label>ΑΦΜ</label></div>
                                <div class="col-8">{{$supplier->afm ?: '-'}}</div>
                            </div>
                            <div class="row">
                                <div class="col-4"><label>Σημειώσεις ή παρατηρήσεις</label></div>
                                <div class="col-8"><textarea class="form-control" rows="2">{{$supplier->description ?: '-'}}</textarea></div>
                            </div>
                        </div>
                        <div class="col">
                            <h5>Οικονομικά στοιχεία</h5>
                            <div class="row">
                                <div class="col-4"><label>Πλήθος τιμολογίων :</label></div>
                                <div class="col-8">{{$invoice_count ?: '0'}}</div>
                            </div>
                            <div class="row">
                                <div class="col-4"><label>Σύνολο χρεώσεων :</label></div>
                                <div class="col-8">{{$sum_charged .' €' ?: '0 €'}}</div>
                            </div>
                            <div class="row">
                                <div class="col-4"><label>Σύνολο πληρωμών :</label></div>
                                <div class="col-8">{{$paid .' €' ?: '0 €'}}</div>
                            </div>
                            <div class="row">
                                <div class="col-4"><label>Υπόλοιπο :</label></div>
                                <div class="col-8"> <strong>{{$new_balance ?: '0'}}</strong> €</div>
                            </div>
                        </div>
                       
                    </div>
                    
            </div>
            <div class="card-footer text-center py-2">
               <a href="/suppliers" class="btn btn-info shadow-sm"> Επιστροφή </a>
            </div>
        </div>
</div>
@endsection