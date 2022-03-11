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
                                 <label class="align-middle">Προμηθευτής</label>
                              </div>
                              <div class="col-7">
                                 <select class="form-control js-example-basic-single" name="supplier_id" id="inputSupplier">
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
                                 @else
                                    <input class="form-control" type="text" id="inputOrderDate" placeholder="Δεν έχει συσχετισθεί παραγγελία" disabled>
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
                                          @if ($invoice->shipment_id == null)
                                             <option value="" selected>Δεν θα καταχωρηθεί προσωρινά</option>   
                                          @else
                                             <option value="{{ $invoice->shipment->shipper_id }}" selected>{{ $invoice->shipment->shipper->name }}</option>
                                          @endif
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
                                       @if ($invoice->shipment_id != null)
                                          <input class="form-control" name="shipment_invoice_number" value="{{ $invoice->shipment->shipment_invoice_number }}"type="text" id="inputShipmentNumber" autocomplete="off">   
                                       @else
                                          <input class="form-control" name="shipment_invoice_number" type="text" id="inputShipmentNumber" autocomplete="off">   
                                       @endif
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-5 text-end justify-content-center">
                                       <label for="inputShipmentPrice" class="align-middle">Συνολική χρεώση (€)</label>
                                    </div>
                                    <div class="col-7">
                                       @if ($invoice->shipment_id != null)
                                          <input class="form-control" value="{{ $invoice->shipment->shipment_price }}" name="shipment_price" type="number" step="0.01" id="inputShipmentPrice" autocomplete="off">
                                       @else
                                          <input class="form-control" name="shipment_price" type="number" step="0.01" id="inputShipmentPrice" autocomplete="off">
                                       @endif
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-5 text-end justify-content-center">
                                       <label for="inputExtraShipper" class="align-middle">Επιπλέον μεταφορική</label>
                                    </div>
                                    <div class="col-7">
                                       <select class="form-control" id="inputExtraShipper" name="extra_shipper_id" >
                                          @if ($invoice->shipment_id != null && $invoice->shipment->extra_shipper_id != null)
                                             <option value="{{ $invoice->shipment->extra_shipper_id }}" selected>{{ $invoice->shipment->extraShipper->name }}</option>
                                          @else
                                             <option value="none" selected disabled hidden>Δεν υπήρξε ενδιάμεση μεταφορική</option>   
                                          @endif
                                          
                                          @foreach ($shippers as $shipper)
                                             <option type="text" value="{{ $shipper->id }}">{{ $shipper->name }} </option>
                                          @endforeach
                                       </select>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-5 text-end justify-content-center">
                                       <label for="inputExtraPrice" class="align-middle">Xρεώση 2ης μεταφορικής (€)</label>
                                    </div>
                                    <div class="col-7">
                                       @if ($invoice->shipment_id != null)
                                          <input class="form-control" value="{{ $invoice->shipment->extra_price }}" name="extra_price" type="number" step="0.01" id="inputExtraPrice" autocomplete="off">   
                                       @else
                                          <input class="form-control" name="extra_price" type="number" step="0.01" id="inputExtraPrice" autocomplete="off">   
                                       @endif
                                    </div>
                                 </div>
                              </div>
                              <div class="tab-pane fade" id="shared" role="tabpanel" aria-labelledby="shared-tab">
                                 <br>
                                 <h6>Επιλέξτε το τιμολόγιο μεταφορικής με το οποίο ήρθε</h6><br>
                                 <p><i class="fas fa-exclamation-triangle"></i> Ελέγξτε αν είναι ο σωστός προμηθευτής στην αριστερή καρτέλα</p><br>
                                 <select class="form-control" name="shared_shipment" id="shared_shipment">
                                    <option value="null" selected>Επιλέξτε φορτωτική</option>
                                       @foreach ($shipments as $shipment)
                                          @if($shipment->supplier_id != null && $shipment->supplier_id == $invoice->supplier_id)
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
                        <th style="width: 5%" class="p-0 order-font">α/α</th>
                        <th style="width: 5%" class="p-0 order-font">Παραγγελία</th>
                        <th style="width: 5%" class="p-0 order-font">Ποσ.</th>
                        <th style="width: 5%" class="p-0 order-font">Μ/Μ</th>
                        <th style="width: 40%" class="p-0 order-font">Προϊόν</th>
                        <th style="width: 6%" class="p-0 order-font">Τιμή μονάδας</th>
                        <th style="width: 5%" class="p-0 order-font">Καθ. αξία</th>
                        <th style="width: 5%" class="p-0 order-font">Έκπ %</th>
                        <th style="width: 5%" class="p-0 order-font">Αξία</th>
                        <th style="width: 5%" class="p-0 order-font">ΦΠΑ %</th>
                        <th style="width: 5%" class="p-0 order-font">ΦΠΑ</th>
                        <th style="width: 6%" class="p-0 order-font">Τελική Τιμή</th>
                     </tr>
                  </thead>
                  <tbody>
                     @php
                        $count = 1;
                     @endphp
                     @foreach ($details as $detail)
                        <tr id="productRow{{$count}}">
                           <input type="hidden" name="detail{{$count}}" value="{{ $detail->id }}">
                           <td class="p-0 order-font" id="aa{{$count}}">{{$count}}</td>
                           <td>
                              @include('invoices.edit_invoice_connect_order')
                              @if ($detail->order_id == null)
                                 <button type="button" class="btn btn-warning shadow-sm" data-bs-toggle="modal" data-bs-target="#orderConnect"><i class="fas fa-link"></i></button>
                              @else
                                 <button type="button" class="btn btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#orderConnect"><i class="fas fa-link"></i></button>
                              @endif
                              
                           </td>
                           <td class="p-0 order-font">
                              <input value="{{ $detail->quantity }}" class="form-control p-0 pe-2 text-end order-font" name="quantity{{$count}}" id="quantity{{$count}}" required="required" type="number" step="0.01">
                           </td>   
                           <td class="p-0 order-font">
                              <input value="{{$detail->measurement_unit}}" type="text" class="form-control p-0 pe-2 text-end order-font" name="measurement_unit{{$count}}" id="measurementUnit{{$count}}">
                           </td>
                           <td>
                              <select class="form-control js-example-basic-single" name="product{{$count}}" id="product{{$count}}">
                                 <option value="{{ $detail->product_id }}" selected>[{{ $detail->product->detsis_code}}],[{{$detail->product->product_code}}]-{{ $detail->product->product_name }}</option>
                                 @foreach ($products as $product)
                                    <option value="{{ $product->id }}">[{{ $product->detsis_code}}],[{{$product->product_code}}]-{{ $product->product_name }}</option>
                                 @endforeach
                              </select>
                           </td>
                           <td class="p-0">
                              <input value="{{ $detail->net_value }}" type="number" step="0.0001" class="form-control p-0 pe-2 text-end order-font" name="net_value{{$count}}" id="netValue{{$count}}" min="0" required="required">
                           </td>
                           <td class="p-0">
                              <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" id="sumNetValue{{$count}}" min="0" readonly="readonly">
                           </td>
                           <td class="p-0">
                              <input value="{{ $detail->product_discount}}" type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="product_discount{{$count}}" value="0.00"min="0" max="100" id="productDiscount{{$count}}">
                           </td>
                           <td class="p-0">
                              <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" value="0.00" min="0" id="value{{$count}}" readonly="readonly">
                           </td>
                           <td class="p-0">
                              <input value="{{ $detail->tax_rate }}" type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="tax_rate{{$count}}" value="24.00" min="0" max="100" id="taxRate{{$count}}">
                           </td>
                           <td class="p-0">
                              <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" id="tax{{$count}}" readonly="readonly">
                           </td>
                           <td class="p-0">
                              <input value="{{ $detail->price }}" type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="price{{$count}}" min="0" id="price{{$count}}" readonly="readonly">
                           </td>
                           
                        </tr>
                        
                        @php
                           $count++;
                        @endphp
                     @endforeach
                     <input type="hidden" name="count" id="count" value="{{$count-1}}">
                  </tbody>
               </table>
               <div>
                  <button type="button" id="addProduct" class="btn btn-warning me-5 ms-5"> + Προσθήκη προϊόντος </button>
               </div>
            </div> <!-- End of products row -->
            
            <div class="row m-2"><!-- Row 3 -->
                  <div class="col-7 border rounded">
                     <div class="col-sm-2"><label for="inputNotes">Σημειώσεις</label></div>
                     <div class="col-sm-12"><textarea rows="4" class="form-control" type="text" id="inputNotes" name="notes" value="{{ $invoice->notes }}">{{ $invoice->notes }}</textarea></div>
                  </div>
                  <div class="col-1"></div>
                  <div class="col-4 border rounded-3 p-2">
                     <div class="row">
                        <div class="col"><div class="text-end">Συνολική καθαρή αξία :</div></div>
                        <div class="col"><input class="form-control text-end p-0 pe-2" value="{{ $invoice->invoice_total / (1 + $invoice->invoice_tax_rate / 100) - $invoice->extra_charges }}" id="invoiceNetValue"></div>
                     </div>
                     <div class="row">
                        <div class="col"><div class="text-end">Έκπτωση παραγγελίας:</div></div>
                        <div class="col"><input class="form-control text-end p-0 pe-2" value="{{ $invoice->order_discount }}" name="order_discount" min="0" id="orderDiscount"></div>                        
                     </div>
                     <div class="row">
                        <div class="col"><div class="text-end">Επιβαρύνσεις (€):</div></div>
                        <div class="col"><input class="form-control text-end p-0 pe-2" value="{{ $invoice->extra_charges }}" name="extra_charges" min="0" id="extraCharges"></div>
                     </div>
                     <div class="row">
                        <div class="col"><div class="text-end">ΦΠΑ (%) :</div></div>
                        <div class="col"><input class="form-control text-end p-0 pe-2" value="{{ $invoice->invoice_tax_rate }}" name="invoice_tax_rate" min="0" id="invoiceTaxRate"></div>
                     </div>
                     <div class="row">
                        <div class="col"><div class="text-end">ΦΠΑ (€):</div></div>
                        <div class="col"><input class="form-control text-end p-0 pe-2" value="{{ $invoice->invoice_total -$invoice->invoice_total / (1 + $invoice->invoice_tax_rate / 100) -$invoice->extra_charges }}" id="tax"></div>
                     </div>
                     <div class="row">
                        <div class="col"><div class="text-end">Σύνολο :</div></div>
                        <div class="col"><input class="form-control text-end p-0 pe-2" value="{{ $invoice->invoice_total }}" id="invoiceTotal" name="invoice_total"></div>
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