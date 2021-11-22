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
    //determining the count of details
    var count = $('#count').val();
    console.log("count = "+ count);
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
        $('#orderDiscount'+i).on('keyup', function() {
            updatePrice(i);
        });

        $('#netValue'+i).on('focusout', function() {
            this.value = parseFloat(this.value).toFixed(2);
        });

        $('#taxRate'+i).on('focusout', function() {
            this.value = parseFloat(this.value).toFixed(2);
        });

        $('#productDiscount'+i).on('focusout', function() {
            this.value = parseFloat(this.value).toFixed(2);
        });

        //updateOrderSums(count);
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
        shipmentPrice = parseFloat(shipmentPrice).toFixed(2);

        var extraPrice = $('#inputExtraPrice').val();
        extraPrice = parseFloat(extraPrice).toFixed(2);

        var order_discount = $('#orderDiscount').val();
        order_discount = parseFloat(order_discount).toFixed(2);

        // updating fields of product details
        $('#inputShipmentPrice').val(shipmentPrice);
        $('#inputExtraPrice').val(extraPrice);
        $('#sumNetValue'+x).val(sum_net_value);
        $('#value'+x).val(value);
        $('#orderDiscount').val(order_discount);
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
            total_tax = $('#value'+i).val() * $('#taxRate'+i).val()/100 + total_tax;
            order_price = Number(order_net_value) + Number(total_tax);
            tax_rate = $('#orderTaxRate').val();
        }
    }
    // formatting and outputing total net value
    order_net_value = Math.round(order_net_value*100)/100;
    order_net_value = parseFloat(order_net_value).toFixed(2);
    $('#orderNetValue').val(order_net_value);

    // Getting the order discount (irrelevant to the product discount) and outputing it
    $order_discount = $('#orderDiscount').val()/100;
    
    order_net_value_final = order_net_value - order_net_value * $order_discount;
    order_net_value_final = Math.round(order_net_value_final*100)/100;
    order_net_value_final = parseFloat(order_net_value_final).toFixed(2)
    total_tax = order_net_value_final * tax_rate/100;
    total_tax = Math.round(total_tax*100)/100;
    total_tax = parseFloat(total_tax).toFixed(2)
    
    order_price_final = Number(order_net_value_final) + Number(total_tax);

    order_price_final = Math.round(order_price_final*100)/100;
    order_price_final = parseFloat(order_price_final).toFixed(2)
        
    $('#tax').val(total_tax);
    
    $('#orderPrice').val(order_price_final);

    setTimeout(function() { updateFields(); }, 1500);
}

