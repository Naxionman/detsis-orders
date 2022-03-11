<div class="row justify-content-center mt-1">
    <div class="col-6">
        <label for="dailyWages">Βασικό Ημερομίσθιο</label>
    </div>
    <div class="col-3">
        <input class="form-control" type="number" step="0.01" name="daily_wages" id="dailyWages">
    </div>
</div>
<div class="row justify-content-center mt-1">
    <div class="col-6">
        <label for="">Επίδομα Τριετίας</label>
    </div>
    <div class="col-3">
        <input class="form-control" type="number" step="0.01" name="three_year_benefit" id="3yearBenefit">
    </div>
</div>
<div class="row justify-content-center mt-1">
    <div class="col-6">
        <label for="">Επίδομα Γάμου</label>
    </div>
    <div class="col-3">
        <input class="form-control" type="number" step="0.01" name="marriage_benefit" id="marriageBenefit">
    </div>
</div>
<div class="row justify-content-center mt-1">
    <div class="col-6">
        <label for="">Νόμιμο Ημερομήσθιο</label>
    </div>
    <div class="col-3">
        <input class="form-control" type="number" step="0.01" name="total_wages" id="totalWages">
    </div>
</div>
        <script>
            $('#dailyWages, #3yearBenefit, #marriageBenefit').on('change', function(){
                var dailyWages = $('#dailyWages').val();
                dailyWages = Math.round(dailyWages*100)/100;
                dailyWages = parseFloat(dailyWages).toFixed(2);
                var yearBenefit = $('#3yearBenefit').val();
                yearBenefit = Math.round(yearBenefit*100)/100;
                yearBenefit = parseFloat(yearBenefit).toFixed(2);
                var marriageBenefit = $('#marriageBenefit').val();
                marriageBenefit = Math.round(marriageBenefit*100)/100;
                marriageBenefit = parseFloat(marriageBenefit).toFixed(2);

                var total = Number(dailyWages) + Number(yearBenefit) + Number(marriageBenefit);
                total = Math.round(total*100)/100;
                total = parseFloat(total).toFixed(2);
                $('#dailyWages').val(dailyWages);
                $('#3yearBenefit').val(yearBenefit);
                $('#marriageBenefit').val(marriageBenefit);
                $('#totalWages').val(total);
            });
            
        </script>
<div class="row justify-content-center mt-1">
    <div class="col-6">
        <label for="">Ασφαλιστικές κρατήσεις εργαζομένου</label>    
    </div>
    <div class="col-3">
        <input class="form-control" type="number" step="0.01" name="insurance_deduction_daily" id="insuranceDeductionDaily">
    </div>
</div>

<div class="row justify-content-center mt-1">
    <div class="col-6">
        <label for="">ΣΥΝΟΛΟ ΣΥΜΦΩΝΗΘΕΝΤΟΣ ΗΜΕΡΟΜΙΣΘΙΟΥ</label>    
    </div>
    <div class="col-3">
        <input class="form-control" type="number" step="0.01" name="agreed_daily_wages_sum" id="agreedDailyWagesSum">
    </div>
</div>

<div class="row justify-content-center mt-1">
    <div class="col-6">
        <label for="">ΩΡΟΜΙΣΘΙΟ</label>    
    </div>
    <div class="col-3">
        <input class="form-control" type="number" step="0.01" name="hourly_wage" id="hourlyWage">
    </div>
</div>
<br>

<div class="row justify-content-center mt-1">
    <div class="col-6">
        <label for="">ΣΤΟΙΧΕΙΑ ΜΙΣΘΟΔΟΤΙΚΗΣ ΠΕΡΙΟΔΟΥ</label>    
    </div>
    
</div>

<div class="row justify-content-center mt-1">
    <div class="col-6">
        <label for="">Κανονικές αποδοχές</label>    
    </div>
    <div class="col-3">
        <input class="form-control" type="number" step="0.01" name="gross_earnings" id="grossEarnings">
    </div>
</div>

<div class="row justify-content-center mt-1">
    <div class="col-6">
        <label for="">Ασθένεια Α</label>    
    </div>
    <div class="col-3">
        <input class="form-control" type="number" step="0.01" name="illness" id="illness">
    </div>
</div>

<div class="row justify-content-center mt-1">
    <div class="col-6">
        <label for="">ΣΥΝΟΛΟ ΑΠΟΔΟΧΩΝ</label>    
    </div>
    <div class="col-3">
        <input class="form-control" type="number" step="0.01" name="monthly_gross_earnings" id="total2">
    </div>
</div>
<script>
    $('#grossEarnings, #illness').on('change', function(){
        var grossEarnings = $('#grossEarnings').val();
        grossEarnings = Math.round(grossEarnings*100)/100;
        grossEarnings = parseFloat(grossEarnings).toFixed(2);
        var illness = $('#illness').val();
        illness = Math.round(illness*100)/100;
        illness = parseFloat(illness).toFixed(2);
        
        var total2 = Number(grossEarnings) + Number(illness);
        total2 = Math.round(total2*100)/100;
        total2 = parseFloat(total2).toFixed(2);
        $('#grossEarnings').val(grossEarnings);
        $('#illness').val(illness);        
        $('#total2').val(total2);
    });
    
</script>
<div class="row justify-content-center mt-1">
    <div class="col-6">
        <label>ΑΣΦΑΛΙΣΤΙΚΕΣ ΚΡΑΤΗΣΕΙΣ ΕΡΓΑΖΟΜΕΝΟΥ</label>    
    </div>
</div>

<div class="row justify-content-center mt-1">
    <div class="col-6">
        <select name="insurance_deduction_type" class="form-control" id="insuranceDeductionType">
            <option value="101 - ΙΚΑ ΝΙΚΤΑ - ΕΤΑΜ">101 - ΙΚΑ ΜΙΚΤΑ - ΕΤΑΜ</option>
            <option value="102 - ΙΚΑ ΝΙΚΤΑ - ΕΤΑΜ ΜΕ ΕΠΑΓΓΕΛΜΑΤΙΚΟ ΚΙΝΔΥΝΟ">102 - ΙΚΑ ΜΙΚΤΑ - ΕΤΑΜ ΜΕ ΕΠΑΓΓΕΛΜΑΤΙΚΟ ΚΙΝΔΥΝΟ</option>
            <option value="105 - ΙΚΑ ΝΙΚΤΑ - ΕΤΑΜ - ΒΑΡΕΑ">105 - ΙΚΑ ΜΙΚΤΑ - ΕΤΑΜ - ΒΑΡΕΑ</option>
        </select>
    </div>
    <div class="col-3">
        <input class="form-control" type="number" step="0.01" name="insurance_deduction_monthly" id="insuranceDeductionMonthly">
    </div>
</div>
<div class="row justify-content-center mt-1">
    <div class="col-6">
        <label for="totalInsuranceDeduction">ΣΥΝΟΛΟ ΑΣΦΑΛΙΣΤΙΚΩΝ ΚΡΑΤΗΣΕΩΝ</label>    
    </div>
    <div class="col-3">
        <input class="form-control" type="number" step="0.01" id="totalInsuranceDeduction">
    </div>
</div>
<br>

<div class="row justify-content-center mt-1">
    <div class="col-6">
        <label for="">ΚΡΑΤΗΣΕΙΣ ΦΜΥ</label>    
    </div>
    <div class="col-3">
        <input class="form-control" type="number" step="0.01" name="payroll_tax_deduction">
    </div>
</div>

<div class="row justify-content-center mt-1">
    <div class="col-6">
        <label for="netSalary">ΠΛΗΡΩΤΕΕΣ ΑΠΟΔΟΧΕΣ</label>    
    </div>
    <div class="col-3">
        <input class="form-control" type="number" step="0.01" name="net_salary" id="netSalary">
    </div>
</div>
<div class="row justify-content-center mt-1">
    <div class="col-6">
        <label for="advance">ΠΡΟΚΑΤΑΒΟΛΗ</label>    
    </div>
    <div class="col-3">
        <input class="form-control" type="number" step="0.01" name="advance" id="advance">
    </div>
</div>

<div class="row justify-content-center mt-1">
    <div class="col-6">
        <label for="paiSalary"><strong>ΥΠΟΛΟΙΠΟ ΠΛΗΡΩΤΕΩΝ ΑΠΟΔΟΧΩΝ</strong></label>    
    </div>
    <div class="col-3">
        <input class="form-control" type="number" step="0.01"  id="paidSalary">
    </div>
</div>



