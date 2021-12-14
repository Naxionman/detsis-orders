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
    $.fn.select2.defaults.set( "theme", "bootstrap" );
    $('#product0').select2();
    $('.js-example-basic-single').select2();
    
    if (top.location.pathname.match(/^\/add_invoice\//)) {
        
        //determining the count of details
        var count = $('#count').val();

        updateFields();

        

        //Enable/Disable a row (if products of an order are not included in the invoice)
        for (let i = 1; i < count+1; i++) {
            $('#check'+i).on('change', function(){
                if($('#quantity'+i).is(':disabled')){
                    console.log("change");
                    $('#quantity'+i).prop( "disabled", false );
                    $('#measurementUnit'+i).prop( "disabled", false );
                    $('#itemsPerPackage'+i).prop( "disabled", false );
                    $('#netValue'+i).prop( "disabled", false );
                    $('#sumNetValue'+i).prop( "disabled", false );
                    $('#productDiscount'+i).prop( "disabled", false );
                    $('#value'+i).prop( "disabled", false );
                    $('#taxRate'+i).prop( "disabled", false );
                    $('#tax'+i).prop( "disabled", false );
                    $('#price'+i).prop( "disabled", false );
                }else{
                    $('#quantity'+i).prop( "disabled", true );
                    $('#measurementUnit'+i).prop( "disabled", true );
                    $('#itemsPerPackage'+i).prop( "disabled", true );
                    $('#netValue'+i).prop( "disabled", true );
                    $('#sumNetValue'+i).prop( "disabled", true );
                    $('#productDiscount'+i).prop( "disabled", true );
                    $('#value'+i).prop( "disabled", true );
                    $('#taxRate'+i).prop( "disabled", true );
                    $('#tax'+i).prop( "disabled", true );
                    $('#price'+i).prop( "disabled", true );
                }

            });

            //Auto-calculation while typing in the fields that are available
            $('#netValue'+i).on('input keyup keydown', () => {
                    updatePrice(i);
                });
            
            $('#quantity'+i).on('input keyup keydown', () => {
                    updatePrice(i);
                });

            $('#productDiscount'+i).on('input keyup keydown', () => {
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
            $('#extraCharges, #orderDiscount,#inputShipmentPrice, #invoiceTaxRate,#inputExtraPrice, #netValue'+i+',#taxRate'+i+',#productDiscount'+i).on('focusout',function (){
                this.value = Math.round(this.value*100)/100;
                this.value = parseFloat(this.value).toFixed(2);
            });
        }
    }

    function updatePrice(x){
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

            updateFields();
        }
    }
});

function updateFields(){
    var count = $('#count').val();
    
    var invoice_net_value = 0;
    var total_tax = 0;
    var invoice_total = 0;
    
    for (let i = 0; i < count+1; i++) {
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
    
    //setTimeout(function() { updateFields(); }, 500);
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
