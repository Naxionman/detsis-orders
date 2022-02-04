<!--                                        Explaining terms:
            
    quantity = The quantity of the ordered product by its measurment unit
    measurment unit = It can be sets, (single) items, packages
    items_per_package = In case someone ships and charges for packages, we need to regulate the quantities in our stock
                        by multiplying items per package times the quasntity 
                        (e.g. 10 packages. Each contain 16 bottles => we have 16*10 bottles for our stock)
    net_value = The net value of a single unit 
    sum_net_value = net value multiplied by quantity
    product_discount = It's apllied to the sum_net_value and produces the value (not saved to the database, as it's 
                        only used for the rest of the calculations)
    value = The value AFTER the discount. This is important! It's the sum of the net values AFTER the discount.
    tax_rate = Not likely, but it may always change. It's percentage. This is applied to the value (not net_value, nor sum_net_value)
    tax = value * tax_rate. Just to show the taxes and add the all together
    price = This is the fianl price of the product (net_value-> sum_net_value->discount->tax_rate->price).
            
-->

<!-- List of ordered goods -->
<div class="row">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Ήρθαν;</th>
                <th style="width: 5%">α/α</th>
                <th>DCode</th>
                <th>Κωδ.Προμηθευτή</th>
                <th>Ποσότητα</th>
                <th>Μ/Μ</th>
                <th>Ανά συσκ.</th>
                <th>Περιγραφή προϊόντος</th>
                <th>Τιμή μονάδας</th>
                <th>Καθαρή αξία</th>
                <th>Έκπτωση %</th>
                <th>Αξία</th>
                <th>ΦΠΑ %</th>
                <th>ΦΠΑ</th>
                <th>Τελική Τιμή</th>
            </tr>
        </thead>
        
        <tbody>    
        @php
            $count = 0
        @endphp          
        @foreach ($details as $detail)
            @if ($detail->pending == 1)
            @php
                $count +=1;
            @endphp
                <tr id="tr">
                    <input type="hidden" name="product_id{{$count}}" value="{{ $detail->product->id }}">
                    <input type="hidden" name="detail_id{{$count}}" value="{{ $detail->id }}">
                    <td>
                        <input type="hidden" name="arrived{{$count}}" value="0">
                        <div class="form-check"><input class="form-check-input" type="checkbox" value="1" name="arrived{{$count}}" id="check{{$count}}" checked></div>
                    </td>
                    <td style="width: 5%" class="p-0 order-font">{{ $count }}</td>
                    <td style="width: 10%" class="p-0 order-font">{{ $detail->product->detsis_code }}</td>
                    <td style="width: 10%" class="p-0 order-font">{{ $detail->product->product_code }}</td>
                    <td style="width: 5%" class="p-0 order-font">
                        <input type="number" class="form-control p-0 pe-2 text-end order-font" name="quantity{{$count}}" value="{{ $detail->quantity }}" id="quantity{{$count}}">
                    </td>
                    <td class="p-0">
                        <input type="text" class="form-control p-0 pe-2 text-end order-font" name="measurement_unit{{$count}}" id="measurementUnit{{$count}}" value="{{ $detail->measurement_unit == null ?: 'ΤΕΜ'}}">
                    </td>
                    <td class="p-0">
                        <input type="number" class="form-control p-0 pe-2 text-end order-font" name="items_per_package{{$count}}" id="itemsPerPackage{{$count}}" value="{{ $detail->items_per_package == null ?: '1'}}">
                    </td>
                    <td style="width: 30%" class="p-0 order-font" >{{ $detail->product->product_name }}</td>
                    <td style="width: 5%" class="p-0">
                        <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="net_value{{$count}}" id="netValue{{$count}}" min="0" required>
                    </td>
                    <td style="width: 5%" class="p-0">
                        <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="sum_net_value{{$count}}" id="sumNetValue{{$count}}" min="0" readonly="readonly">
                    </td>
                    <td style="width: 5%" class="p-0">
                        <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="product_discount{{$count}}" value="0.00"min="0" max="100" id="productDiscount{{$count}}">
                    </td>
                    <td style="width: 5%" class="p-0">
                        <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="value{{$count}}" value="0.00"min="0" id="value{{$count}}" readonly="readonly">
                    </td>
                    <td style="width: 5%" class="p-0">
                        <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="tax_rate{{$count}}" value="24.00" min="0" max="100" id="taxRate{{$count}}">
                    </td>
                    <td style="width: 5%" class="p-0">
                        <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="tax{{$count}}" min="0" id="tax{{$count}}" readonly="readonly">
                    </td>
                    <td style="width: 10%" class="p-0">
                        <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="price{{$count}}" min="0" id="price{{$count}}" readonly="readonly">
                    </td>
                </tr>
                @else
                <tr style="color:#808080"">
                    <td>
                        <input type="hidden" name="arrived{{$count}}" value="1">
                        <div class="form-check"><input class="form-check-input" type="checkbox" checked disabled>*</div>
                    </td>
                    <td style="width: 5%" class="p-0 order-font">{{ $count }}</td>
                    <td style="width: 10%" class="p-0 order-font">{{ $detail->product->detsis_code }}</td>
                    <td style="width: 10%" class="p-0 order-font">{{ $detail->product->product_code }}</td>
                    <td style="width: 5%" class="p-0 order-font">
                        <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font"  value="{{ $detail->quantity }}" id="quantity{{ $count }}"disabled>
                    </td>
                    <td class="p-0">
                        <input type="text" class="form-control p-0 pe-2 text-end order-font" id="measurementUnit{{$count}}" value="{{ $detail->measurement_unit == null ?: 'ΤΕΜ'}}" disabled>
                    </td>
                    <td class="p-0">
                        <input type="number" class="form-control p-0 pe-2 text-end order-font" id="itemsPerPackage{{$count}}" value="{{ $detail->items_per_package == null ?: '1'}}"disabled>
                    </td>
                    <td style="width: 30%" class="p-0 order-font" >{{ $detail->product->product_name }}</td>
                    <td style="width: 5%" class="p-0">
                        <input type="number" step="0.0001" class="form-control p-0 pe-2 text-end order-font"  id="netValue{{$count}}" min="0" disabled>
                    </td>
                    <td style="width: 5%" class="p-0">
                        <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" min="0" readonly="readonly"disabled>
                    </td>
                    <td style="width: 5%" class="p-0">
                        <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" value="0.00"min="0" max="100" id="productDiscount{{$count}}"disabled>
                    </td>
                    <td style="width: 5%" class="p-0">
                        <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" value="0.00"min="0" id="value{{$count}}" readonly="readonly"disabled>
                    </td>
                    <td style="width: 5%" class="p-0">
                        <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" value="24.00" id="taxRate{{$count}}"disabled>
                    </td>
                    <td style="width: 5%" class="p-0">
                        <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" id="tax{{$count}}" readonly="readonly"disabled>
                    </td>
                    <td style="width: 10%" class="p-0">
                        <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" id="price{{$count}}" readonly="readonly">
                    </td>
                </tr>

                @endif            
        @endforeach
        </tbody>
    </table>
    <input type="hidden" name="count" id="count" value="{{$count}}">
    <input type="hidden" name="supplier_id" value="{{$order->supplier_id}}">
    
</div>
    @foreach ($details as $detail)
        @if($detail->pending == 0)
            <div class="row mb-2"><p style="font-style: italic;">* Τα προϊόντα έχουν έρθει σε προηγούμενη παράδοση</p></div>    
            @break
        @endif
    @endforeach
    
<div class="row m-2">
    <div class="col-7 border rounded">
        <div class="m-2">Σημειώσεις :</div>
        <textarea form="addInvoice" name="notes" id="inputNotes" cols="90" rows="10">{{ $order->notes }}</textarea>
        
    </div>
    <div class="col-1"></div>
    <div class="col-2 border rounded-start">
        <div class="row">
            <div class="text-end">Συνολική καθαρή αξία :</div>
        </div>
        <div class="row">
            <div class="text-end">Έκπτωση παραγγελίας :</div>
        </div>
        <div class="row">
            <div class="text-end">Επιβαρύνσεις :</div>
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
    <div class="col-2 border rounded-end">
        <div class="row">
            <input type="number" step="0.01" readonly="readonly" class="form-control p-0 pe-2 text-end order-font" min="0" id="invoiceNetValue">
        </div>
        <div class="row">
            <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="order_discount" min="0" id="orderDiscount" value="0.00">
        </div>
        <div class="row">
            <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="extra_charges" min="0" id="extraCharges" value="0.00">
        </div>
        <div class="row">
            <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="invoice_tax_rate" min="0" id="invoiceTaxRate" value="24.00">
        </div>
        <div class="row">
            <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" min="0" id="tax">
        </div>
        <div class="row">
            <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="invoice_total" min="0" id="invoiceTotal">
        </div>
    </div>
</div>