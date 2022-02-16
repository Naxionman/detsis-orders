@extends('template')

@section('title', 'Επεξεργασία Τιμολογίου')

@section('content')
   <div class="container">
      <div class="card bg-danger shadow-lg border-0 rounded-3 mt-3 ">
         <form action="/edit_invoice/{{ $invoice->id }}" id="editInvoice" method="post">
            @method('PATCH')
         <div class="card-header"><h3 class="text-center font-weight-light my-2 ">Τιμολόγιο {{ $invoice->id }}</h3></div>
         <div class="card-body bg-light">
            <div class="row mt-2"><!-- First Row (2 column-cards) -->
               <div class="col"><!-- Left column -->
                  <div class="card bg-danger bg-opacity-75 border-0 rounded-3 shadow-sm">
                        <div class="card-header text-light font-weight-light">Στοιχεία παραστατικού</div>
                        <div class="card-body bg-light">
                           <div class="row">
                              <div class="col-5 text-end justify-content-center">
                                 <label class="align-middle">Σύνδεση με παραγγελία/ες</label>
                              </div>
                              <div class="col-7">
                                 <select class="form-control js-example-basic-multiple" multiple='multiple'name="orders[]" id="boundOrders">
                                    @for ($i = 0; $i < count($details); $i++)
                                       @if ($details[$i]->order_id == null)
                                          {{ '-' }}
                                          @break
                                       @else
                                          @if ($i-1 < 0) <!-- Checking index bounds -->
                                             <option value="{{ $details[$i]->order_id }}" selected id="boundOrder{{$i}}">{{ $details[$i]->order_id }}</option>   
                                          @else
                                             @if ($details[$i]->order_id != $details[ $i-1]->order_id)
                                                <option value="{{ $details[$i]->order_id }}" selected selected id="boundOrder{{$i}}">{{ $details[$i]->order_id }}</option>   
                                             @endif
                                          @endif
                                       @endif 
                                    @endfor   
                                    @foreach ($orders as $order)
                                       <option id="boundOrder" value="{{ $order->id }}">{{ $order->id }} : {{ $order->client->surname }} {{ $order->client->name }} από {{ $order->supplier->company_name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>

                           <div class="row">
                              <div class="col-5 text-end justify-content-center">
                                 <label class="align-middle">Προμηθευτής</label>
                              </div>
                              <div class="col-7">
                                 <select class="form-control js-example-basic-single" name="supplier_id">
                                    <option value="{{ $invoice->supplier_id }}" selected>{{ $invoice->supplier->company_name }}</option>
                                    @foreach ($suppliers as $supplier)
                                       <option value="{{ $supplier->id }}">{{ $supplier->company_name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>

                           <div class="row">
                              <div class="col-5 text-end justify-content-center">
                                 <label class="align-middle">Ημερομηνία παραγγελίας*</label>
                              </div>
                              <div class="col-7">
                                 @if( $invoice->orderDetails->first->order_id != null)
                                    <input class="form-control" type="date" value="{{ $invoice->orderDetails->first()->order->order_date->format("Y-m-d")}}" name="order_date" id="inputOrderDate">
                                 @endif
                              </div>
                           </div>
                              
                           <div class="row">
                              <div class="col-5 text-end justify-content-center">
                                 <label class="align-middle">Ημερομηνία άφιξης</label>
                              </div>
                              <div class="col-7">
                                    @if ($invoice->shipment_id != null)
                                       <input class="form-control" type="date" name="shipping_date" value="{{ $invoice->shipment->shipping_date->format('Y-m-d') }}">
                                    @else
                                       <input class="form-control" type="text" placeholder="Δεν έχει ορισθεί φορτωτική" disabled> 
                                    @endif
                               </div>
                           </div>

                           <div class="row">
                              <div class="col-5 text-end justify-content-center">
                                 <label class="align-middle">Ημερομηνία τιμολόγησης</label>
                              </div>
                              <div class="col-7">
                                 <input class="form-control" name="invoice_date" type="date" value="{{ $invoice->invoice_date->format('Y-m-d') }}">
                              </div>
                           </div>

                           <div class="row">
                              <div class="col-5 text-end justify-content-center"><label class="align-middle">Αριθμός Τιμολογίου Προμηθευτή</label></div>
                              <div class="col-7">
                                 <input class="form-control" value="{{  $invoice->supplier_invoice_number }}" type="text" name="supplier_invoice_number">
                              </div>
                           </div>
                           <i> * - Η ημερομηνία της παραγγελίας προκύπτει από εκείνη που έγινε πο νωρίς</i>
                        </div>
                  </div>
               </div>
               
               <div class="col"><!-- Second column (Μεταφορική) -->
                  <div class="card bg-danger bg-opacity-75 border-0 rounded-3 shadow-sm">
                     <div class="card-header text-light font-weight-light">Τιμολόγιο Μεταφορικής</div>
                     <div class="card-body bg-light">
                        <div class="col border rounded-3 shadow-sm">
                           <ul class="nav nav-tabs" id="myTab" role="tablist">
                              <li class="nav-item" role="presentation">
                                 <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Νέο Τιμολόγιο μεταφορικής</button>
                              </li>
                              <li class="nav-item" role="presentation">
                                 <button class="nav-link" id="shared-tab" data-bs-toggle="tab" data-bs-target="#shared" type="button" role="tab" aria-controls="shared" aria-selected="false">Καταχώρηση σε ήδη υπάρχον</button>
                              </li>
                           </ul>
                           <div class="tab-content p-2" id="myTabContent">
                              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                 <div class="row">
                                    <div class="col-5 text-end justify-content-center">
                                       <label for="inputShipper" class="align-middle">Μεταφορική</label>
                                    </div>
                                    <div class="col-7">
                                       <select class="form-control" id="inputShipper" name="shipper_id">
                                          <option value="" selected>Δεν θα καταχωρηθεί προσωρινά</option>
                                          @foreach ($shippers as $shipper)
                                             <option type="text" value="{{ $shipper->id }}">{{ $shipper->name }}</option>
                                          @endforeach
                                       </select>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-5 text-end justify-content-center">
                                       <label for="inputShipmentNumber" class="align-middle">Αριθμός Τιμολογίου</label>
                                    </div>
                                    <div class="col-7">
                                       <input class="form-control" name="shipment_invoice_number" type="text" id="inputShipmentNumber" autocomplete="off">
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-5 text-end justify-content-center">
                                       <label for="inputShipmentPrice" class="align-middle">Συνολική χρεώση</label>
                                    </div>
                                    <div class="col-7">
                                       <input class="form-control" name="shipment_price" type="number" step="0.01" id="inputShipmentPrice" autocomplete="off">
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-5 text-end justify-content-center">
                                       <label for="inputExtraShipper" class="align-middle">Επιπλέον μεταφορική</label>
                                    </div>
                                    <div class="col-7">
                                       <select class="form-control" id="inputExtraShipper" name="extra_shipper_id" >
                                          <option value="none" selected disabled hidden>Δεν υπήρξε ενδιάμεση μεταφορική</option>
                                          @foreach ($shippers as $shipper)
                                             <option type="text" value="{{ $shipper->id }}">{{ $shipper->name }} </option>
                                          @endforeach
                                       </select>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-5 text-end justify-content-center">
                                       <label for="inputExtraPrice" class="align-middle">Xρεώση 2ης μεταφορικής</label>
                                    </div>
                                    <div class="col-7">
                                       <input class="form-control" name="extra_price" type="number" step="0.01" id="inputExtraPrice" autocomplete="off">
                                    </div>
                                 </div>
                              </div>
                              <div class="tab-pane fade" id="shared" role="tabpanel" aria-labelledby="shared-tab">
                                 <br>
                                 <h6>Επιλέξτε το τιμολόγιο μεταφορικής με το οποίο ήρθε</h6>
                                 <p><i class="fas fa-exclamation-triangle"></i> Ελέγξτε αν είναι ο σωστός προμηθευτής στην αριστερή καρτέλα</p>
                                 <select class="form-control js-example-basic-single" name="shared_shipment" id="shared_shipment">
                                    <option value="null" selected></option>
                                    @foreach ($shipments as $shipment)
                                       @if($shipment->supplier_id != null)
                                       <option value="{{ $shipment->id }}">{{ $shipment->shipment_invoice_number }} - {{ $shipment->shipper->name }},[{{ $shipment->supplier->company_name }}]</option>
                                       @endif   
                                    @endforeach
                                 </select>
                                 <br>
                                 <br>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div><!-- First row of cards -->   
            <br>
            <div class="row"> <!-- 2nd Row (table of products) -->
               <table class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th style="width: 5%">α/α</th>
                        <th>Ποσ.</th>
                        <th>Μ/Μ</th>
                        <th>Ανά συσκ.</th>
                        <th>Περιγραφή προϊόντος</th>
                        <th>Τιμή μονάδας</th>
                        <th>Καθαρή αξία</th>
                        <th>Έκπτωση (%)</th>
                        <th>Αξία</th>
                        <th>ΦΠΑ (%)</th>
                        <th>ΦΠΑ (€)</th>
                        <th>Τελική Τιμή</th>
                     </tr>
                  </thead>
                  <tbody>
                     @php
                        $count = 0;
                     @endphp
                     @foreach ($details as $detail)
                        @php
                           $count += 1;
                        @endphp
                           <tr>
                              <td style="width: 3%" class="p-0 order-font">{{ $count }}</td>
                              <td style="width: 3%" class="p-0 text-end pe-1 order-font">
                                 <input class="form-control" type="number" step="0.01" value="{{ $detail->quantity.$count }}" name="quantity{{$count}}">   
                              </td>
                              <td style="width: 3%" class="p-0 text-end order-font">
                                 <input class="form-control" type="text" value="{{ $detail->measurement_unit }}" name="measurement_unit{{$count}}">
                              </td>
                              <td style="width: 5%" class="p-0 text-end order-font">
                                 <input class="form-control" type="text" value="{{ $detail->items_per_package }}" name="items_per_package{{$count}}"
                              </td>
                              <td style="width: 30%" class="p-0 text-start ps-0 order-font">
                                 <select class="js-example-basic-single" name="product{{$count}}" id="product{{$count}}">
                                    <option value="{{ $detail->product->id }}" selected>[{{ $detail->product->detsis_code }}],[{{$detail->product->supplier_code}}],{{$detail->product->product_name}}</option>
                                    @foreach ($products as $product)
                                       <option value="{{$product->id}}">[{{ $product->detsis_code}}],[{{$product->product_code}}],{{ $product->product_name }}</option>
                                    @endforeach
                                 </select>
                              </td>
                              <td style="width: 5%" class="p-0 pe-2 text-end">
                                 {{ number_format($detail->net_value, 4, ',', '.') }}
                              </td>
                              <td style="width: 5%" class="p-0 pe-2 text-end">{{ number_format($detail->net_value * $detail->quantity, 2, ',', '.') }}</td>
                              <td style="width: 5%" class="p-0 pe-2 text-end">{{ number_format($detail->product_discount, 2, ',', '.') }}</td>
                              <td style="width: 5%" class="p-0 pe-2 text-end">{{ number_format($detail->net_value * $detail->quantity - ($detail->net_value * $detail->quantity * $detail->product_discount) / 100,2,',','.') }}</td>
                              <td style="width: 5%" class="p-0 pe-2 text-end">{{ number_format($detail->tax_rate, 2, ',', '.') }}</td>
                              <td style="width: 5%" class="p-0 pe-2 text-end">{{ number_format((($detail->net_value * $detail->quantity -($detail->net_value * $detail->quantity * $detail->product_discount) / 100) *$detail->tax_rate) /100,2,',','.') }}</td>
                              <td style="width: 10%" class="p-0 pe-2 text-end">{{ number_format($detail->price, 2, ',', '.') }}</td>
                           </tr>
                     @endforeach
                  </tbody>
               </table>
            </div> <!-- End of products row -->
            <div class="row m-2"><!-- Row 3 -->
                  <div class="col-7 border rounded">
                     <div class="col-sm-2"><label for="inputNotes">Σημειώσεις</label></div>
                     <div class="col-sm-12"><textarea rows="4" class="form-control" type="text" id="inputNotes" name="notes" value="{{ $invoice->notes }}">{{ $invoice->notes }}</textarea></div>
                  </div>
                  <div class="col-1"></div>
                  <div class="col-3 border rounded-start">
                     <div class="row">
                        <div class="text-end">Συνολική καθαρή αξία :</div>
                     </div>
                     <div class="row">
                        <div class="text-end">Έκπτωση παραγγελίας:</div>
                     </div>
                     <div class="row">
                        <div class="text-end">Επιβαρύνσεις (€):</div>
                     </div>
                     <div class="row">
                        <div class="text-end">ΦΠΑ (%) :</div>
                     </div>
                     <div class="row">
                        <div class="text-end">ΦΠΑ (€):</div>
                     </div>
                     <div class="row">
                        <div class="text-end">Σύνολο :</div>
                     </div>
                  </div>
                  <div class="col-1 border rounded-end">
                     <div class="row">
                        <div class="text-end">{{ number_format($invoice->invoice_total / (1 + $invoice->invoice_tax_rate / 100) - $invoice->extra_charges,2,',','.') }}</div>
                     </div>
                     <div class="row">
                        <div class="text-end">{{ number_format($invoice->order_discount, 2, ',', '.') }}</div>
                     </div>
                     <div class="row">
                        <div class="text-end">{{ number_format($invoice->extra_charges, 2, ',', '.') }}</div>
                     </div>
                     <div class="row">
                        <div class="text-end">{{ number_format($invoice->invoice_tax_rate, 2, ',', '.') }}</div>
                     </div>
                     <div class="row">
                        <div class="text-end">{{ number_format($invoice->invoice_total -$invoice->invoice_total / (1 + $invoice->invoice_tax_rate / 100) -$invoice->extra_charges,2,',','.') }}</div>
                     </div>
                     <div class="row">
                        <div class="text-end">{{ number_format($invoice->invoice_total, 2, ',', '.') }}</div>
                     </div>
                  </div>
            </div><!-- end of row 3 -->
         </div>
         @csrf
         </form>
         <div class="card-footer text-center py-2">
            <button class="btn btn-danger shadow-sm" type="submit" form="editInvoice">  Αποθήκευση </button>
            <a href="javascript:history.back()" class="btn btn-info shadow-sm"> Ακύρωση - Επιστροφή </a>
         </div>
      </div><!-- card -->
   </div> <!-- container -->
 @endsection