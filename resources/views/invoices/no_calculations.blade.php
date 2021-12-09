<div class="row">
    <div class="col mb-3">
        <label for="inputNotes" class="form-label">Σημειώσεις παραγγελίας</label>
        <textarea class="form-control" name="notes" id="inputNotes" rows="10">{{ $order->notes }}</textarea>
    </div>
    <div class="col mb-3">
        <label for="inputInvoiceTotal" class="form-label">Πληρωτέο ποσό</label>
        <input class="form-control" type="number" step="0.01" name="invoice_total" required="required" id="inputInvoiceTotal">
        
    </div>    
</div>
