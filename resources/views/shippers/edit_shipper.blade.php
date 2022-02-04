@extends('template')

@section('title', 'DetsisOrders - Επεξεργασία στοιχείων Μεταφορικής')

@section('content')
<div class="container">
    <div class="card bg-warning bg-opacity-25 shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 ">Επεξεργασία στοιχείων μεταφορικής</h3></div>
            <div class="card-body bg-light">
                <form action="/edit_shipper/{{ $shipper->id }}" id="editShipper" method="POST">
                @method('PATCH')
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputName">Ονομασία Εταιρείας</label></div>
                        <div class="col-sm-4"><input class="form-control" value="{{$shipper->name}}" autocomplete="nope" type="text" id="inputName" name="name" required="required"></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputPhone">Τηλέφωνο</label></div>
                        <div class="col-sm-4"><input class="form-control" value="{{ $shipper->phone }}" autocomplete="nope" type="tel" id="inputPhone" name="phone1" placeholder="Τηλέφωνο"></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputEmail">E-mail</label></div>
                        <div class="col-sm-4"><input class="form-control" value="{{ $shipper->email }}" autocomplete="off" type="email" id="inputEmail" name="email" placeholder="Ηλεκτρονική διεύθυνση της εταιρείας" data-error="Δεν έχετε βάλει έγκυρο e-mail!"></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputWebsite">Ιστοσελίδα</label></div>
                        <div class="col-sm-4"><input class="form-control" value="{{ $shipper->website }}" autocomplete="nope" type="url" id="inputWebsite" name="website" placeholder="Ιστοσελίδα εταιρείας" ></div>
                    </div>    
                    
                    @csrf
                </form>
            </div>
            <div class="card-footer text-center py-2">
                <button class="btn btn-danger shadow-sm" type="submit" form="editShipper">  Αποθήκευση Αλλαγών </button>
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