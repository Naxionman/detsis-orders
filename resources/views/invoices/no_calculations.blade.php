<div class="row">
    <div class="col mb-3">
        <label for="inputNotes" class="form-label"><strong>Σημειώσεις παραγγελίας</strong></label>
        <textarea class="form-control" name="notes" id="inputNotes" rows="6">{{ $order->notes }}</textarea>
    </div>
    <div class="col mb-3">
        <div class="row">
            <label><strong> Ήρθε ολόκληρη η παραγγελία;</strong></label>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="0" name="pending" id="radio1">
                <label class="form-check-label" for="radio1">Ναι, ήρθε ολόκληρη!</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" value="1" name="pending" id="radio2" checked>
                <label class="form-check-label" for="radio2">Όχι, ήρθε μόνο μέρος της.</label>
              </div>
        </div>
        <div class="row mt-4">
            <label for="inputInvoiceTotal" class="form-label"><strong>Πληρωτέο ποσό</strong></label>
            <input class="form-control" type="number" step="0.01" name="invoice_total" required="required" id="inputInvoiceTotal">
        </div>
    </div>    
</div>
