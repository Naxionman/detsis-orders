@extends('template')

@section('title', 'DetsisOrders - Πίνακας Ελέγχου')

@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-md-3 col-xl-3">
            <div class="card2 bg-c-blue order-card2">
                <div class="card2-block">
                    <h6 class="m-b-20">Μηνιαίες παραγγελίες</h6>
                    <hr class = "row mt-0">
                    <div class="row">
                        <h2>
                            <i class="fa fa-cart-plus f-left"></i>
                            <span class="f-right">9  <!-- Code for monthly orders  --></span>
                        </h2>
                    </div>
                    
                    <div class="row">
                            <div class = "col-8">Καθ'οδόν</div>
                                <span class="col-4 text-end">                        
                                    2     <!-- Code for pending orders  -->
                                </span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-xl-3">
            <div class="card2 bg-c-pink order-card2">
                <div class="card2-block">
                    <h6 class="m-b-20">Τιμολόγια μεταφορικών</h6>
                    <hr class = "row mt-0">
                    <div class="row">
                        <h2>
                            <i class="fas fa-truck f-left"></i>
                            <span class="f-right">436 €  <!-- Code for monthly orders  --></span>
                        </h2>
                    </div>
                    
                    <div class="row">
                            <div class = "col-8">Dionysos Cargo</div>
                                <span class="col-4 text-end">                        
                                    398 €     <!-- Code for pending orders  -->
                                </span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-xl-3">
            <div class="card2 bg-c-green order-card2">
                <div class="card2-block">
                    <h6 class="m-b-20">Άλλη μία κάρτα</h6>
                    <hr class = "row mt-0">
                    <div class="row">
                        <h2>
                            <i class="fas fa-car f-left"></i>
                            <span class="f-right">436 €  <!-- Code for monthly orders  --></span>
                        </h2>
                    </div>
                    
                    <div class="row">
                            <div class = "col-8">Dionysos Cargo</div>
                                <span class="col-4 text-end">                        
                                    398 €     <!-- Code for pending orders  -->
                                </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-xl-3">
            <div class="card2 bg-c-yellow order-card2">
                <div class="card2-block">
                    <h6 class="m-b-20">Τελευταία κάρτα</h6>
                    <hr class = "row mt-0">
                    <div class="row">
                        <h2>
                            <i class="fas fa-car f-left"></i>
                            <span class="f-right">5.038 €  <!-- Code for monthly orders  --></span>
                        </h2>
                    </div>
                    
                    <div class="row">
                            <div class = "col-8">Επιπλέον</div>
                                <span class="col-4 text-end">                        
                                    398 €     <!-- Code for pending orders  -->
                                </span>
                    </div>
                </div>
            </div>
        </div>


    </div> <!-- 4-card row ending -->

    <div class="row mt-2">

    

    </div> <!-- end of main row -->

</div>
    
@endsection