/*!
    * Start Bootstrap - SB Admin v7.0.4 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2021 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts


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

//For using table rows as link
$('tr[data-href]').on("click", function() {
    document.location = $(this).data('href');
});


jQuery(function() {
    
    $('[data-toggle="tooltip"]').tooltip();
    $.fn.select2.defaults.set( "theme", "bootstrap" );
    $('#product0').select2();
    $('.js-example-basic-single').select2();
    
    if (top.location.pathname.match(/^\/add_invoice\//) || top.location.pathname.match('/add_special_invoice') ) {
        

        $('#sharedSupplierInvoice').on('change',function () {
            console.log("Shared invoice change!");
            if($('#sharedSupplierInvoice').val() != 'null'){
                console.log("Not null !!!!");
                $('#inputShipper').prop( "disabled", true );
                $('#inputShipmentNumber').prop( "disabled", true );
                $('#inputShipmentPrice').prop( "disabled", true );
                $('#inputExtraShipper').prop( "disabled", true );
                $('#inputExtraPrice').prop( "disabled", true );
                $('#inputInvoiceTotal').prop( "disabled", true );
            } else {
                $('#inputShipper').prop( "disabled", false );
                $('#inputShipmentNumber').prop( "disabled", false );
                $('#inputShipmentPrice').prop( "disabled", false );
                $('#inputExtraShipper').prop( "disabled", false );
                $('#inputExtraPrice').prop( "disabled", false );
                $('#inputInvoiceTotal').prop( "disabled", false );
            }
        });

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


    if(top.location.pathname === '/add_product'){
        var productCodes = JSON.parse(window.count);
        
        console.log(productCodes);        
        var category;
        var subCategory;
        var lastProduct;

        $('#inputDetsisCode').on('input keyup keydown', function () {
            var userInput = $('#inputDetsisCode').val();
            console.log(userInput); 
            //We need to see the categories even if the user has typed more than 5 characters. So we get the first 4 characters only!
            userInput = userInput.substring(0,4);           
                switch (userInput) {
                    case '0101':
                        category = 'Εξαρτήματα επίπλων';
                        subCategory = 'Μεντεσέδες';
                        enterLastProduct();
                        break;

                    case '0102':
                        category = 'Εξαρτήματα επίπλων';
                        subCategory = 'Τακάκια';
                        enterLastProduct();
                        break;
                    case '0103':
                        category = 'Εξαρτήματα επίπλων';
                        subCategory = 'Μηχανισμοί';
                        enterLastProduct();
                        break;
                    case '0201':
                        category = 'Χημικά';
                        subCategory = 'Σιλικόνες';
                        enterLastProduct();
                        break;
                    case '0202':
                        category = 'Εξαρτήματα επίππλων';
                        subCategory = 'Κόλλες';
                        enterLastProduct();
                        break;           
                    default:
                        category = 'Δεν υπάρχει τέτοια κατηγορία';
                        subCategory = 'Δεν υπάρχει τέτοια κατηγορία';
                        enterLastProduct();
                        break;
                }
                $('#category').text(category);
                $('#subCategory').text(subCategory);
                
                function enterLastProduct(){
                    productCodes.forEach(code => {
                        console.log('code = ' + code);
                        if(userInput.substring(0,4) == code.substring(0,4)){
                            lastProduct = code;
                            console.log('last product = '+ lastProduct);
                        }
                    });
                    $('#lastProduct').text(lastProduct);
                }
                
        });
    }

    if(top.location.pathname === '/add_leave'){
        leaveDetails();
    }
});

function daysInMonth (month, year) {
    return new Date(year, month, 0).getDate();
}

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

function leaveDetails(){
    var isFiveDays;
        
    //First Ajax call to get the selected employee's days
    $.ajax({
        url: '/add_leave/'+ 1,
        type: 'GET',
        dataType: 'JSON',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (employeeData) {
            isFiveDays = employeeData[0];
            $('#daysEntitled').text(employeeData[1]);
        },
        error:function() {
            alert("Προσοχή. Έχει γίνει κάποια μαλακία. Καλέστε τον Νικόλα!");
        }         
    });

    $('#inputEmployee').on('change', function() {
        var id = $('#inputEmployee').val();
        console.log('Selected Employee ID is :' + id);
         
        //Ajax call when another employee is selected
        $.ajax({
            url: '/add_leave/'+ id,
            type: 'GET',
            dataType: 'JSON',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            //data : $.param({'id' : id, }),
            success: function (employeeData) {
                isFiveDays = employeeData[0];
                $('#daysEntitled').text(employeeData[1]);
            },
            error:function() {
                alert("Τι στο πούτσο έγινε πάλι;;; Καλέστε τον Νικόλα να το φτιάξει!");
            }         
        });
    });

    //Calculating and updating values
    $('#inputEmployee, #inputStartDate, #inputEndDate').on('click change', function() {
        var startDate = $('#inputStartDate').val();
        var endDate = $('#inputEndDate').val();
        var diff = new Date(Date.parse(endDate) - Date.parse(startDate));
        var daysAsking = diff/1000/60/60/24 + 1;
        
        /* Calculating holidays so that they are automatically out of the equation
         * For 2022 the official holidays in Greece are the following:
            1st of January
            6th of January
            25th of March
            Monday after Easter
            1st of May
            15th of August
            28th of October
            25th of December
            26th of December
        */

            //Easter Mondays until 2030...Well, yeah...
        var EasterMondays = [
            new Date('2022-04-25').getTime(),
            new Date('2023-04-17').getTime(),
            new Date('2024-05-06').getTime(),
            new Date('2025-04-21').getTime(),
            new Date('2026-04-13').getTime(),
            new Date('2027-05-03').getTime(),
            new Date('2028-04-17').getTime(),
            new Date('2029-04-09').getTime(),
            new Date('2030-04-29').getTime(),
        ];
        
        console.log('Asking days intitially are: '+ daysAsking);
        var initialDaysAsking = daysAsking;
        var holidays = 0;
        var saturdays = 0;
        var sundays = 0;

        for (let i = 0; i < (initialDaysAsking); i++) {
            var currentDate = new Date(startDate);
            currentDate.setDate(currentDate.getDate()+i);

            var weekDay = currentDate.getDay();
            var date = currentDate.getDate();
            var month = currentDate.getMonth() + 1;
            var year = currentDate.getFullYear();
            
            if(weekDay == 0) {
                daysAsking--; //If there is a Sunday, it is deducted from the asking days
                sundays++;
            }
            if(weekDay == 6 && isFiveDays){
                daysAsking--;
                saturdays++;
            }

            //Checking if 1st of January is included and it is not a Sunday
            if(date == 1 && month == 1 && weekDay !=0){
                daysAsking--; // 1st of January is an official holiday in Greece
                holidays++;
                console.log(holidays);
            }
            
            //Checking if 6th of January is included and it is not a Sunday
            if(date == 6 && month == 1 && weekDay !=0){
                daysAsking--; // 6th of January is an official holiday in Greece
                holidays++;
                console.log(holidays);
            }

            //Checking if 25th of March is included and it is not a Sunday
            if(date == 25 && month == 3 && weekDay !=0){
                daysAsking--; // 25th of March is a National holiday in Greece
                holidays++;
            }

            //Checking if 25th of March is included and it is not a Sunday
            if(date == 25 && month == 3 && weekDay !=0){
                daysAsking--; // 25th of March is a National holiday in Greece
                holidays++;
            }
            
            //Checking if Easter Monday is included
            if($.inArray(currentDate.getTime(), EasterMondays) > -1){
                daysAsking--;
                holidays++;
            }

            //Checking if 1st of May is included and it is not a Sunday
            if(date == 1 && month == 5 && weekDay !=0){
                daysAsking--; // 1st of May is an official holiday in Greece and is transferred if it's on a Sunday
                holidays++;
            }

            //Checking if 15th of August is included and it is not a Sunday
            if(date == 15 && month == 8 && weekDay !=0){
                daysAsking--; // 15th of August is an official holiday in Greece
                holidays++;
            }

            //Checking if 28th of October is included and it is not a Sunday
            if(date == 28 && month == 10 && weekDay !=0){
                daysAsking--; // 28th of October is a National holiday in Greece
                holidays++;
            }

            //Checking if 25th of December is included and it is not a Sunday
            if(date == 25 && month == 12 && weekDay !=0){
                daysAsking--; // 25th of December is an official holiday in Greece
                holidays++;
            }

            //Checking if 26th of December is included and it is not a Sunday
            if(date == 26 && month == 12 && weekDay !=0){
                daysAsking--; // 26th of December is an official holiday in Greece
                holidays++;
            }
            
        }
        console.log('But Asking days are now: '+ daysAsking);
        if(daysAsking > 0){
            $('#daysAsking').text(daysAsking);
            $('#daysTaken').val(daysAsking);
            //Strings
            var part1 = '';
            var part2 = '';
            var part3 = '';
            var part4 = '';

            if(isFiveDays){
                workingSechedule = 'πενθήμερη';
                saturdaysCount = 'δεν';
                part3 = saturdays + ' Σάββατα και '+ sundays + ' Κυριακές. ';
            } else {
                workingSechedule = 'εξαήμερη';
                saturdaysCount = 'κανονικά';
                part3 = sundays + ' Κυριακές.';
            }
            
            part1 = 'Ο εργαζόμενος δουλεύει σε ' + workingSechedule + ' βάση, οπότε τα Σάββατα ' + saturdaysCount + ' χρεώνονται στην άδεια του. ';
            part2 = 'Από τις ' + initialDaysAsking + ' ημερολογιακές ημέρες, που ζητάει ο εργαζόμενος, αφαιρούνται οι εξής :';
            part4 = 'Οι αργίες που περιλαμβάνονται στην επιλεγμένη περίοδο είναι ' + holidays + '.';
            
            $('#explanationText1').text(part1);
            $('#explanationText2').text(part2);
            $('#explanationText3').text(part3);
            $('#explanationText4').text(part4);
        }
    });

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
        var table = $('#ordersTable').DataTable();
        //Get the toggles
        var showroom = $('#switchShowroom');
        var factory = $('#switchFactory');
        var pending = $('#switchPending');

        var string1 = 'Εμπόριο';
        var string2 = 'Εργοστάσιο';
        var string3 = 'Άφιξη';

        showroom.on('change', function(){
            if(showroom.is(':checked')){
                table.search(string1).draw();
            } else {
                table.search('').draw();
            }    

            if(showroom.is(':checked') && pending.is(':checked')){
                table.search(string1 + ' '+ string3).draw();
            }
        })
        factory.on('change', function(){
            console.log('changed factory');
            if(factory.is(':checked')){
                table.search(string2).draw();
            } else {
                table.search('').draw();
            }    
        })
        pending.on('change', function(){
            if(pending.is(':checked')){
                table.search(string3).draw();
            } else {
                table.search('').draw();
            }    
        })
    }

    //CONFIRMATION of deletion
    $('.show_confirm').on('click', function(e) {
        var form =  $('#deleteForm');
        e.preventDefault();
        Swal.fire({
            title: "Επιβεβαίωση Διαγραφής!!!",
            text: "Είστε απολύτως βέβαιοι ότι θέλετε να κάνετε διαγραφή; Είναι μία μη αντιστρέψιμη ενέργεια!",
            icon: "warning",
            showCancelButton: true,
              confirmButtonColor: '#ff0f15',
              cancelButtonColor: '#ed032d9e9e9e',
              confirmButtonText: 'Ναι! ΔΙΑΓΡΑΦΗ!'
        })
        .then((willDelete) => {
          if (willDelete.isConfirmed) {
            form.trigger('submit');
          }
        });
    });



});


//DOKIMI

function searcher(theSwitch, theString) {
    theSwitch.on('change', function(){
        if(theSwitch.is(':checked')){
            table.search(theString).draw();
        }else {
            table.search('').draw();
        }
    })
}