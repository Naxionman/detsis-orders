@extends('template')

@section('title', 'DetsisOrders - Πίνακας Ελέγχου')

@section('content')
<div class="container">
    <div class="row mt-3">
        <!-- Orders stats -->
        <div class="col-md-3 col-xl-3 position-relative">
            <div class="card2 bg-c-blue order-card2">
                <div class="card2-block">
                    <h6 class="m-b-20">Αναμενόμενες παραγγελίες</h6>
                    <hr class = "row mt-0">
                    <div class="row">
                        <h2>
                            <i class="fa fa-cart-plus f-left"></i>
                            <span class="f-right">{{ $pending_orders }}</span>
                        </h2>
                    </div>
                    
                    <div class="row">
                            <div class = "col-8">Παραγγελίες μήνα</div>
                                <span class="col-4 text-end">{{ $monthly_orders }}</span>
                    </div>
                </div>
                <a href="/orders" class="stretched-link"></a>
            </div>
        </div>
        <!-- Shipments stats -->
        <div class="col-md-3 col-xl-3 position-relative"><!-- This position-relative is to prevent the stretched-link attribute to apply to all the cards -->
            <div class="card2 bg-c-pink order-card2 " >
                <div class="card2-block">
                    <h6 class="m-b-20" >Φορτωτικές Διόνυσου</h6>
                    <hr class = "row mt-0">
                    <div class="row">
                        <h2>
                            <i class="fas fa-truck f-left"></i>
                            <span class="f-right">{{ $monthly_sum }} €</span>
                        </h2>
                    </div>
                    
                    <div class="row">
                            <div class = "col-8">Άλλες μεταφορικές</div>
                                <span class="col-4 text-end">{{ $extra_sum }} €</span>
                    </div>
                </div>
                <a href="/shipments" class="stretched-link"></a>
            </div>
        </div>
        <!--  stats -->
        <div class="col-md-3 col-xl-3 position-relative">
            <div class="card2 bg-c-green order-card2">
                <div class="card2-block">
                    <h6 class="m-b-20">Πάγια έξοδα τρέχοντος έτους</h6>
                    <hr class = "row mt-0">
                    <div class="row">
                        <h2>
                            <i class="fas fa-file-invoice f-left"></i>
                            <span class="f-right">{{ number_format($total_yearly_expences, 2, ".",",") }} €  <!-- Code for total expences this year  --></span>
                        </h2>
                    </div>
                    
                    <div class="row">
                            <div class = "col-7">Προηγούμενο έτος</div>
                                <span class="col-5 text-end">                        
                                    {{ number_format($total_last_year_expences, 2, ".", ",") }} €     <!-- Code for pending orders  -->
                                </span>
                    </div>
                </div>
                <a href="/expences" class="stretched-link"></a>
            </div>
        </div>
        <!--  stats -->
        <div class="col-md-3 col-xl-3">
            <div class="card2 bg-c-yellow order-card2">
                <div class="card2-block">
                    <h6 class="m-b-20">Τελευταία κάρτα</h6>
                    <hr class = "row mt-0">
                    <div class="row">
                        <h2>
                            <i class="fas fa-car f-left"></i>
                            <span class="f-right">0 €  <!-- Code for monthly orders  --></span>
                        </h2>
                    </div>
                    
                    <div class="row">
                            <div class = "col-8">Επιπλέον</div>
                                <span class="col-4 text-end">                        
                                    0 €     <!-- Code for pending orders  -->
                                </span>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- 4-card row ending -->

    <!-- -------    C H A R T S     -------    -->

    <div class="row mt-2 ">
        <div class="col">
            <div class="border border-1 rounded-3 text-center">
                <h5><i class="fas fa-shipping-fast" style="color: rgb(180, 180, 180)"></i> Παραδόσεις Μεταφορικών</h5>
                <hr style="margin-top: 0;">
                <canvas id="shippersChart" width="600" height="300">Μεταφορικές</canvas>
            </div>
        </div>
        <div class="col">
            <div class="border border-1 rounded-3 text-center">
                <h5><i class="fas fa-money-check" style="color: rgb(180, 180, 180)"></i> Παραγγελίες ανα μήνα</h5>
                <hr style="margin-top: 0;">                
                <canvas id="ordersChart" width="600" height="300">σσσσσ</canvas>
            </div>
        </div>
    

    </div> <!-- end of main row -->

</div>

<script>

    // Script for Pie Chart: Shippers

    var shipStats = {!! json_encode($ship_stats, JSON_HEX_TAG) !!};
    console.log(Object.values(shipStats));
    console.log(Object.keys(shipStats));
    const ctx = $('#shippersChart');
    const myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: Object.keys(shipStats),
            datasets: [{
                label: ['# παραδόσεις'],
                data: Object.values(shipStats),
                backgroundColor:[ 'rgb(0,122,55)','rgb(54, 162, 235)','rgb(255, 205, 86)', 'rgb(255,0,58)', 'rgb(73, 0 , 255)','rgb(0, 255, 255)']
            }]
        },
        options: {
            responsive: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Scripts for Bar: Orders
    var orderStatsCurrentYear = {!! json_encode($order_stats_current_year, JSON_HEX_TAG) !!};
    var orderStatsPreviousYear = {!! json_encode($order_stats_previous_year, JSON_HEX_TAG) !!};
    console.log('Orders :'+ Object.values(orderStatsCurrentYear));
    console.log('Month :' + Object.keys(orderStatsCurrentYear));
    console.log('Orders :'+ Object.values(orderStatsPreviousYear));
    console.log('Month :' + Object.keys(orderStatsPreviousYear));
    
    const data2 = {
        labels: ['Ιαν', 'Φεβ', 'Μαρ','Απρ', 'Μάι','Ιούν','Ιούλ','Αύγ','Σεπ','Οκτ','Νοέ', 'Δεκ'],
        datasets: [
            {
                label: ['#Παραγγελίες '+ new Date().getFullYear()],
                data: Object.values(orderStatsCurrentYear),
                backgroundColor: [
                                'rgba(0, 222, 255, 0.6)',
                                'rgba(255, 159, 64, 0.6)',
                                'rgba(255, 205, 86, 0.6)',
                                'rgba(75, 192, 192, 0.6)',
                                'rgba(54, 162, 235, 0.6)',
                                'rgba(153, 102, 255, 0.6)',
                                'rgba(201, 203, 207, 0.6)'
                                ],
                borderColor: [
                                'rgb(0, 222, 255)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(54, 162, 235)',
                                'rgb(153, 102, 255)',
                                'rgb(201, 203, 207)'
                                ],
                borderWidth: 1
            },
            {
                label: ['#Παραγγελίες '+ (new Date().getFullYear() - 1)],
                data: Object.values(orderStatsPreviousYear),
                backgroundColor: [
                                'rgba(255, 30, 30, 0.6)',
                                'rgba(255, 159, 64, 0.6)',
                                'rgba(255, 205, 86, 0.6)',
                                'rgba(75, 192, 192, 0.6)',
                                'rgba(54, 162, 235, 0.6)',
                                'rgba(153, 102, 255, 0.6)',
                                'rgba(201, 203, 207, 0.6)'
                                ],
                borderColor: [
                                'rgb(255, 30, 30)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(54, 162, 235)',
                                'rgb(153, 102, 255)',
                                'rgb(201, 203, 207)'
                                ],
                borderWidth: 1    
            }
        ]
    };

    const ctx2 = $('#ordersChart');
    const orderChart = new Chart(ctx2, {
        type: 'bar',
        data: data2,
        options: {
            scales: {
            yAxes: [{
                ticks: {
                beginAtZero: true,
                callback: function(value) {if (value % 1 === 0) {return value;}}
                }
            }]
            }
        }
    })
</script>
@endsection