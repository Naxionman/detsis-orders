@extends ('template')

@section('title', $product->product_name)

@section('content')
<div class="container">
    <div class="card bg-info bg-opacity-25 shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header">
            <div class="row">
                <div class="col-1">
                    @if ($product->id - 1 != 0)
                        <a style="color: #394f62" class="btn" href="/view_product/{{$product->id - 1}}"><i class="fas fa-chevron-circle-left fa-2x"></i></a>    
                    @endif
                </div>
                <div class="col-10">
                    <h3 class="text-center font-weight-light my-2 ">{{$product->product_name}}
                        <a href="/products" class="btn btn-info shadow-sm"> Επιστροφή στον πίνακα προϊόντων</a></h3>
                </div>
                <div class="col-1">
                    @if ($product->id != $last_product->id)
                        <a style="color: #394f62" class="btn" href="/view_product/{{$product->id + 1}}"><i class="fas fa-chevron-circle-right fa-2x"></i></a>
                    @endif
                </div>
            </div>
        </div>
            <div class="card-body bg-light">
                <div class="row">
                    <div class="col-8">
                        <div class="card bg-info bg-opacity-10 shadow-sm border-2 rounded-3 m-2">
                            <div class="card-header"><h5>Στοιχεία προϊόντος</h5></div>
                            <div class="card-body bg-light">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="row"><div class="text-end">Ονομασία Προμηθευτή:</div></div>
                                        <div class="row"><div class="text-end">Σημειώσεις μας:</div></div>
                                        <div class="row"><div class="text-end">DCode :</div></div>
                                        <div class="row"><div class="text-end">Τελευταίος Προμηθευτής :</div></div>
                                        <div class="row"><div class="text-end">Κωδικός Προμηθευτή :</div></div>
                                        <div class="row"><div class="text-end">Ποσότητα αποθήκης :</div></div>
                                        <div class="row"><div class="text-end">Όριο ποσότητας :</div></div>
                                    </div>
                                    <div class="col-7">
                                        <div class="row"><div class="text-start">{{ $product->product_name }}</div></div>
                                        <div class="row"><div class="text-start">{{ $product->notes ?: '-' }}</div></div>
                                        <div class="row"><div class="text-start">{{ $product->detsis_code }}</div></div>
                                        <div class="row"><div class="text-start">
                                            @if ($product->last_supplier == null)
                                                {{ 'Δεν έχει καταγραφεί κάποια αγορά'}}
                                            @else
                                                {{ $product->last_supplier }}
                                            @endif
                                                    
                                            
                                            
                                        </div></div>
                                        <div class="row"><div class="text-start">{{ $product->product_code }}</div></div>
                                        <div class="row"><div class="text-start">{{ $product->stock_level}}</div></div>
                                        <div class="row"><div class="text-start">{{ $product->min_level }}</div></div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        @if($product->image_url == null)
                            <img class="shadow-sm p-0" src="/images/products/no_image.png" style="border-radius: 30px; width: 256px; height: 256px;">
                        @else
                            <img class="shadow-sm p-0" src="/images/products/{{ $product->image_url }}" style="border-radius: 30px; width: 256px; height: 256px;">
                        @endif
                    </div>
                </div>

                <div class="row border rounded-3 m-2 p-2">
                    <div class="col-8"> 
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                                Πίνακας ιστορικού αγορών
                        </div>
                        <table id="pricesTable" class="cell-border display compact">
                            <thead>
                                <tr >
                                    <th>Ημερομηνία</th>
                                    <th>Πσοσότητα</th>
                                    <th>Καθαρή αξία</th>
                                    <th>Έκπτωση</th>
                                    <th>ΦΠΑ</th>
                                    <th>Τελική ανά μονάδα</th>
                                    <th>Προμηθευτής</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($prices as $price)
                                <tr>
                                    <td>{{ $price->price_date->format('d-m-Y') }}</td>
                                    <td>{{ $price->history_quantity }}</td>
                                    <td>{{ number_format($price->history_price, 4 ,",",".") }} €</td>
                                    <td>{{ $price->history_discount }} %</td>
                                    <td>{{ $price->history_tax_rate }} %</td>
                                    <td>{{ number_format($price->history_price - ($price->history_price * $price->history_discount/100), 4 ,",",".") }}</td>
                                    <td>{{ $price->supplier->company_name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-4">
                        <canvas id="pricesChart" width="400" height="400"></canvas>
                        <script>
                            var prices = {!! json_encode($prices, JSON_HEX_TAG) !!};
                            var dates = [];
                            var perUnits = [];
                            var netValues =[];

                            prices.forEach(element => {
                                
                                var date = new Date(element['price_date']).toLocaleDateString();
                                //var date = new Date(element['price_date']);
                                var perUnit = element['history_price'] - (element['history_price'] * element['history_discount']/100);
                                var price = parseFloat(perUnit).toFixed(4);
                                netValues.push(element['history_price']);
                                perUnits.push(price); 
                                dates.push(date);
                                //console.log(price);
                                //console.log(date);
                            });
                            console.log(dates);


                            const ctx = document.getElementById('pricesChart').getContext('2d');
                            console.log(prices);
                            
                            const myChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: dates,
                                    datasets: [
                                        {
                                            label: 'Αξία μετά έκπτωσης ανά μονάδα',
                                            data: perUnits,
                                            backgroundColor:  '#03ABFF'
                                        }, 
                                        {
                                            label: 'Καθαρή αξία',
                                            data: netValues,
                                            backgroundColor:  '#FFFB03'
                                        
                                        }

                                    ]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                            </script>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center py-2">
                
            </div>
        </div>

</div>
<script>
	$(document).ready(function() {
		$('#pricesTable').dataTable({
            columnDefs: [{ 
                type: 'date-eu', targets: 0 }]}  
            );
	});
</script>
    
@endsection