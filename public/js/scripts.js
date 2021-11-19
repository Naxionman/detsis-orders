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
        $('#net_value'+i).on('keyup', function() {
            updatePrice(i);
        });

        $('#tax_rate'+i).on('keyup', function() {
            updatePrice(i);
        });

        $('#product_discount'+i).on('keyup', function() {
            updatePrice(i);
        });

        $('#net_value'+i).on('focusout', function() {
            this.value = parseFloat(this.value).toFixed(2);
        });

        $('#tax_rate'+i).on('focusout', function() {
            this.value = parseFloat(this.value).toFixed(2);
        });

        $('#product_discount'+i).on('focusout', function() {
            this.value = parseFloat(this.value).toFixed(2);
        });

        //updateOrderSums(count);
    }

    function updatePrice(x){
        //sum_net_value = the net value of the unit multiplied by quantity
        var sum_net_value_raw = $('#net_value'+x).val() * $('#quantity'+x).val();
        var value_raw = $('#sum_net_value'+x).val() - ($('#sum_net_value'+x).val() * $('#product_discount'+x).val()/100);
        var tax_raw = value_raw * $('#tax_rate'+x).val()/100;
        var price_raw = value_raw * $('#tax_rate'+x).val()/100 + value_raw;
        
        // rounding the numbers
        var sum_net_value = Math.round(sum_net_value_raw*100)/100;
        var value = Math.round(value_raw*100)/100;
        var tax = Math.round(tax_raw*100)/100;
        var price = Math.round(price_raw*100)/100;
        
        // formatting
        var sum_net_value_formatted = parseFloat(sum_net_value).toFixed(2);
        var value_formatted = parseFloat(value).toFixed(2);
        var tax_formatted = parseFloat(tax).toFixed(2);        
        var price_formatted = parseFloat(price).toFixed(2);

        // updating fields of product details
        $('#sum_net_value'+x).val(sum_net_value_formatted);
        $('#value'+x).val(value_formatted);
        $('#tax'+x).val(tax_formatted);
        $('#price'+x).val(price_formatted);
        
    }
    
});

function updateFields(){
    var count = $('#count').val();
    
    var order_net_value = 0;
    var total_tax = 0;
    var order_price = 0;
    
    for (let i = 0; i < count+1; i++) {
        if($('#sum_net_value'+i).val() != null){
            order_net_value += Number($('#value'+i).val()) ;
            
            total_tax = $('#value'+i).val() * $('#tax_rate'+i).val()/100 + total_tax;
            order_price = order_net_value + total_tax;
        }
    }
    // formatting and outputing total net value
    net_value_formatted = parseFloat(order_net_value).toFixed(2);
    $('#orderNetValue').val(net_value_formatted);

    // Getting the order discount (irrelevant to the product discount) and outputing it
    

    tax_formatted = parseFloat(total_tax).toFixed(2);
    $('#tax').val(tax_formatted);
    order_price_formatted = parseFloat(order_price).toFixed(2);
    $('#orderPrice').val(order_price_formatted);
    setTimeout(function() { updateFields(); }, 1500);
    
    
    
}