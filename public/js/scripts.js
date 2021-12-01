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

    $('.js-example-basic-single').select2();
    
    if (top.location.pathname.match(/^\/edit_order\//)) {
        
        //determining the count of details
        var count = $('#count').val();
        
        updateFields();
        for (let i = 1; i < count+1; i++) {
            $('#netValue'+i).on('keyup', function() {
                updatePrice(i);
            });

            $('#taxRate'+i).on('keyup', function() {
                updatePrice(i);
            });

            $('#productDiscount'+i).on('keyup', function() {
                updatePrice(i);
            });

            $(':input[type="number"]').on('focusout',function (){
                this.value = Math.round(this.value*100)/100;
                this.value = parseFloat(this.value).toFixed(2);
            });
            
        }
    }

    function updatePrice(x){
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
        $('#inputShipmentPrice').val(shipmentPrice);
        $('#inputExtraPrice').val(extraPrice);
        $('#sumNetValue'+x).val(sum_net_value);
        $('#value'+x).val(value);
        
        $('#tax'+x).val(tax);
        $('#price'+x).val(price);
    }
});

function updateFields(){
    var count = $('#count').val();
    
    var order_net_value = 0;
    var total_tax = 0;
    var order_price = 0;
    
    for (let i = 0; i < count+1; i++) {
        if($('#sumNetValue'+i).val() != null){
            order_net_value += Number($('#value'+i).val()) ;
            total_tax = Number($('#value'+i).val()) * Number($('#taxRate'+i).val()/100) + Number(total_tax);
            order_price = Number(order_net_value) + Number(total_tax);
            tax_rate = $('#orderTaxRate').val();
        }
    }

    // formatting and outputing total net value
    order_net_value = Math.round(order_net_value*100)/100;
    order_net_value = parseFloat(order_net_value).toFixed(2);
    $('#orderNetValue').val(order_net_value);
    
    // Getting the order discount (irrelevant to the product discount) and outputing it
    var order_discount = $('#orderDiscount').val();
    order_discount = Math.round(order_discount*100)/100;
    order_discount = parseFloat(order_discount).toFixed(2);

    var order_charges = $('#orderCharges').val();
    order_charges = Math.round(order_charges*100)/100;
    order_charges = parseFloat(order_charges).toFixed(2);
    
    var order_tax_rate = $('#orderTaxRate').val();
    order_tax_rate = Math.round(order_tax_rate*100)/100;
    order_tax_rate = parseFloat(order_tax_rate).toFixed(2);
    
    
    order_net_value_final = order_net_value - order_net_value * order_discount/100 + Number(order_charges);
    order_net_value_final = Math.round(order_net_value_final*100)/100;
    order_net_value_final = parseFloat(order_net_value_final).toFixed(2);
    console.log("order net value final" + order_net_value_final);
    total_tax = order_net_value_final * order_tax_rate/100;
    total_tax = Math.round(total_tax*100)/100;
    total_tax = parseFloat(total_tax).toFixed(2);
    
    order_price_final = Number(order_net_value_final) + Number(total_tax);
    order_price_final = Math.round(order_price_final*100)/100;
    order_price_final = parseFloat(order_price_final).toFixed(2);
    
    $('#tax').val(total_tax);
    
    $('#orderPrice').val(order_price_final);
    
    setTimeout(function() { updateFields(); }, 1000);
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
