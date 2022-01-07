/*!
    * Start Bootstrap - SB Admin v7.0.4 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2021 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }
});

$('tr[data-href]').on("click", function() {
    document.location = $(this).data('href');
});

jQuery(function() {
    
    $('[data-toggle="tooltip"]').tooltip();
    $.fn.select2.defaults.set( "theme", "bootstrap" );
    $('#product0').select2();
    $('.js-example-basic-single').select2();
    
    if (top.location.pathname.match(/^\/add_invoice\//) || top.location.pathname.match('/add_special_invoice') ) {
        
        //determining the count of details and updating it when addProduct is pressed
        var count = $('#count').val();
        
        calculate(count);
        updateFields(count);
        $('#addProduct').on('click', function () {
            count++;
            console.log('new count is :' + count);
            calculate(count);
            updateFields(count);
        });

        //Enable/Disable a row (if products of an order are not included in the invoice)
        for (let j = 1; j < Number(count)+2; j++) {
            $('#check'+j).on('change', function(){
                if($('#quantity'+j).is(':disabled')){
                    console.log("change");
                    $('#quantity'+j).prop( "disabled", false );
                    $('#measurementUnit'+j).prop( "disabled", false );
                    $('#itemsPerPackage'+j).prop( "disabled", false );
                    $('#netValue'+j).prop( "disabled", false );
                    $('#sumNetValue'+j).prop( "disabled", false );
                    $('#productDiscount'+j).prop( "disabled", false );
                    $('#value'+j).prop( "disabled", false );
                    $('#taxRate'+j).prop( "disabled", false );
                    $('#tax'+j).prop( "disabled", false );
                    $('#price'+j).prop( "disabled", false );
                }else{
                    $('#quantity'+j).prop( "disabled", true );
                    $('#measurementUnit'+j).prop( "disabled", true );
                    $('#itemsPerPackage'+j).prop( "disabled", true );
                    $('#netValue'+j).prop( "disabled", true );
                    $('#sumNetValue'+j).prop( "disabled", true );
                    $('#productDiscount'+j).prop( "disabled", true );
                    $('#value'+j).prop( "disabled", true );
                    $('#taxRate'+j).prop( "disabled", true );
                    $('#tax'+j).prop( "disabled", true );
                    $('#price'+j).prop( "disabled", true );
                }
            });
        }
    }

    if(top.location.pathname === '/add_special_invoice'){
        var counter = Number($('#count').val());
        $('#addProduct').on('click', function () {
            
            
            //select2 special requirment: You need to destroy the dropdown before cloning!
            $('#product'+counter).select2('destroy');

            //We clone the last element!
            $('#productRow'+counter).last().clone().attr('id', 'productRow' + ++counter).appendTo('tbody');
            
            $('#product'+ (counter-1)).select2();

            //Changing the ids of its children...
            $($('#productRow'+ counter)).find("[id]").add($('#productRow'+ counter)).each(function() {
                if(this.id != 'count') {
                    this.id = this.id.replace(/\d+$/, "") + counter;
                }
                $('#count').val(counter);
            });

            //now that the new select product has taken its id we can make it select2
            $('#product'+ counter).select2();

            //...and the names
            $('#quantity'+ counter).attr('name','quantity'+ counter);
            $('#measurementUnit'+ counter).attr('name','measurement_unit'+ counter);
            $('#product'+ counter).attr('name','product'+ counter);
            $('#netValue'+ counter).attr('name','net_value'+ counter);
            $('#sumNetValue'+ counter).attr('name','sum_net_value'+ counter);
            $('#productDiscount'+ counter).attr('name','product_discount'+ counter);
            $('#value'+ counter).attr('name','value'+ counter);
            $('#taxRate'+ counter).attr('name','tax_rate'+ counter);
            $('#tax'+ counter).attr('name','tax'+ counter);
            $('#price'+ counter).attr('name','price'+ counter);
            
            //Why not the counter as well?
            $("#aa"+counter).html(counter);

            calculate(counter);
            updateFields(counter);

        });

        $('.removeInputField').on('click', function () {
            var addedRow = $(this).parents('.tbody')
            if (addedRow.get(0).id !== 'productRow') addedRow.remove();
        });
    }

    function calculate(count){
        for (let i = 1; i < Number(count)+1; i++) {
            //Auto-calculation while typing in the fields that are available
            console.log('(inside calculate) i is '+i);
            $('[id^=netValue]').on('input keyup keydown', () => {
                
                console.log("typing in netValue" + i);
                updatePrice(i);
            });

            $('#quantity'+i).on('input keyup keydown','.input', () => {
            console.log("typing in quantity" + i);
                updatePrice(i);
            });

            $('#productDiscount'+i).on('input keyup keydown', () => {
            console.log("typing in productDiscount" + i);
                updatePrice(i);
            });

            $('#taxRate'+i).on('input keyup keydown', () => {
                updatePrice(i);
            });

            $('#orderDiscount').on('input keyup keydown', () => {
                updatePrice(i);
            });

            $('#extraCharges').on('input keyup keydown', () => {
                updatePrice(i);
            });

            $('#invoiceTaxRate').on('input keyup keydown', () => {
                updatePrice(i);
            });

            //Beautifying numbers
            $('#extraCharges, #orderDiscount,#inputShipmentPrice, #invoiceTaxRate,#inputExtraPrice, #taxRate'+i+',#productDiscount'+i).on('focusout',function (){
                this.value = Math.round(this.value*100)/100;
                this.value = parseFloat(this.value).toFixed(2);
            });
            $('#netValue'+i).on('focusout',function (){
                this.value = Math.round(this.value*10000)/10000;
                this.value = parseFloat(this.value).toFixed(4);
            });
        }
        
    }
    
    function updatePrice(x){
        console.log('x is ' + x);
        if(!$('#quantity'+x).prop(':disabled')){
            //sum_net_value = the net value of the unit multiplied by quantity
            var sum_net_value = $('#netValue'+x).val() * $('#quantity'+x).val();
            sum_net_value = Math.round(sum_net_value*100)/100;
            sum_net_value = parseFloat(sum_net_value).toFixed(2);

            //value = the value of the quantity after the discount
            var value = $('#sumNetValue'+x).val() - ($('#sumNetValue'+x).val() * $('#productDiscount'+x).val()/100);
            value = Math.round(value*100)/100;
            value = parseFloat(value).toFixed(2);
                    
            var tax = value * $('#taxRate'+x).val()/100;
            tax = Math.round(tax*100)/100;
            tax = parseFloat(tax).toFixed(2);

            var price = value * $('#taxRate'+x).val()/100 + Number(value);
            price = Math.round(price*100)/100;
            price = parseFloat(price).toFixed(2);

            var shipmentPrice = $('#inputShipmentPrice').val();
            shipmentPrice = Math.round(shipmentPrice*100)/100;
            shipmentPrice = parseFloat(shipmentPrice).toFixed(2);

            var extraPrice = $('#inputExtraPrice').val();
            extraPrice = Math.round(extraPrice*100)/100;
            extraPrice = parseFloat(extraPrice).toFixed(2);

            // updating fields of product details
            $('#sumNetValue'+x).val(sum_net_value);
            $('#value'+x).val(value);
            $('#tax'+x).val(tax);
            $('#price'+x).val(price);

            updateFields(count);
        }
    }

    //Bank selector
    $('#bank1icon').on('click', function () {
        $('#inputBank').val('Τράπεζα Πειραιώς');
    });
    $('#bank2icon').on('click', function () {
        $('#inputBank').val('Εθνική Τράπεζα');
    });
    $('#bank3icon').on('click', function () {
        $('#inputBank').val('Eurobank');
    });
    $('#bank4icon').on('click', function () {
        $('#inputBank').val('Alpha Bank');
    });


});

function updateFields(count){
    console.log("count in updateFields = " + count);
    var invoice_net_value = 0;
    var total_tax = 0;
    var invoice_total = 0;
    
    for (let i = 0; i < Number(count)+1; i++) {
        if(!$('#quantity'+i).is(':disabled')){
            if($('#sumNetValue'+i).val() != null){
                invoice_net_value += Number($('#value'+i).val()) ;
                total_tax = Number($('#value'+i).val()) * Number($('#taxRate'+i).val()/100) + Number(total_tax);
                invoice_total = Number(invoice_net_value) + Number(total_tax);
                tax_rate = $('#orderTaxRate').val();
            }
        }
    }

    // formatting and outputing total net value
    invoice_net_value = Math.round(invoice_net_value*100)/100;
    invoice_net_value = parseFloat(invoice_net_value).toFixed(2);
    $('#invoiceNetValue').val(invoice_net_value);
    
    // Getting the order discount (irrelevant to the product discount) and outputing it
    var order_discount = $('#orderDiscount').val();
    order_discount = Math.round(order_discount*100)/100;
    order_discount = parseFloat(order_discount).toFixed(2);

    var extra_charges = $('#extraCharges').val();
    extra_charges = Math.round(extra_charges*100)/100;
    extra_charges = parseFloat(extra_charges).toFixed(2);
    
    var invoice_tax_rate = $('#invoiceTaxRate').val();
    invoice_tax_rate = Math.round(invoice_tax_rate*100)/100;
    invoice_tax_rate = parseFloat(invoice_tax_rate).toFixed(2);
    
    
    var invoice_net_value_final = invoice_net_value - invoice_net_value * order_discount/100 + Number(extra_charges);
    invoice_net_value_final = Math.round(invoice_net_value_final*100)/100;
    invoice_net_value_final = parseFloat(invoice_net_value_final).toFixed(2);
    console.log("invoice net value final" + invoice_net_value_final);
    total_tax = invoice_net_value_final * invoice_tax_rate/100;
    total_tax = Math.round(total_tax*100)/100;
    total_tax = parseFloat(total_tax).toFixed(2);
    
    invoice_total_final = Number(invoice_net_value_final) + Number(total_tax);
    invoice_total_final = Math.round(invoice_total_final*100)/100;
    invoice_total_final = parseFloat(invoice_total_final).toFixed(2);
    
    $('#tax').val(total_tax);
    
    $('#invoiceTotal').val(invoice_total_final);
}

jQuery(function(){
    //Fucntion used to hide description column from suppliers table, but make it still searchable (for the tags)
    if(top.location.pathname === '/suppliers'){
        var table = $('#myTable').DataTable({
            columnDefs: [{
              targets: 0,
              searchable: true,
                visible: false
            }]
          });
        
        var showroom = $('#switchShowroom');
        var factory = $('#switchFactory');

        showroom.on('change', function(){
            if(showroom.is(':checked')){
                table.search('Εμπόριο').draw();
            } else {
                table.search('').draw();
            }    
        })
        factory.on('change', function(){
            if(factory.is(':checked')){
                table.search('Εργοστάσιο').draw();
            } else {
                table.search('').draw();
            }    
        })
    }

    if (top.location.pathname === '/orders') {
        //Get the table
        var table = $('#myTable').DataTable();
        //Get the toggles
        var showroom = $('#switchShowroom');
        var factory = $('#switchFactory');
        var pending = $('#switchPending');

        showroom.on('change', function(){
            if(showroom.is(':checked')){
                table.search('Εμπόριο').draw();
            } else {
                table.search('').draw();
            }    
        })
        factory.on('change', function(){
            if(factory.is(':checked')){
                table.search('Εργοστάσιο').draw();
            } else {
                table.search('').draw();
            }    
        })
        pending.on('change', function(){
            if(pending.is(':checked')){
                table.search('Άφιξη').draw();
            } else {
                table.search('').draw();
            }    
        })
    }
});


//DOKIMI
