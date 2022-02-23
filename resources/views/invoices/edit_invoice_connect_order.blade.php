<!-- Modal -->
<div class="modal fade" id="orderConnect" tabindex="-1" role="dialog" aria-labelledby="title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleLong">Σύνδεση με παραγγελία</h5>
            </div>
            <div class="modal-body">
                <p>Σύνδεση τιμολογίου με παραγγελία : Κάθε γραμμή που αντιστοιχεί στα προϊόντα του τιμολογίου δύναται να αντιστοιχεί σε μία παραγγελία. Βεβαιωθείτε ότι έχετε συνδέσει κάθε γραμμή που χρειάζεται να συνδεθεί με παραγγελία.</p>
                <div class="row">
                    <label for="currentOrder">Συσχετισμένη παραγγελία :</label>
                    @if ($detail->order_id == null)
                        <span>Καμία συσχέτιση</span> 
                    @else
                        <a href="/view_order/{{ $detail->order_id }}">[{{ $detail->order_id }}],{{$detail->order->client->surname}} {{ $detail->order->client->name }} από {{ $detail->order->supplier->company_name }}</a>
                    @endif
                </div>
                
                
                <div class="row justify-content-center">
                    <label for="inputOrder">Παραγγελία για σύνδεση :</label>
                </div>
                <div class="row justify-content-center">
                    <select class="form-control js-example-basic-single" name="order{{$count}}" id="order{{$count}}">
                        @if ($detail->order_id != null)
                            <option value="{{ $detail->order_id }}" selected>[{{ $detail->order_id }}],{{$detail->order->client->surname}} {{ $detail->order->client->name }} από {{ $detail->order->supplier->company_name }}</option>
                        @else
                            <option selected>Επιλέξτε μία παραγγελία για συσχέτιση</option>    
                        @endif
                        
                        @foreach ($orders as $order)
                            <option value="{{$order->id}}">[{{$order->id}}], {{$order->client->surname}} {{$order->client->name}} από {{$order->supplier->company_name}}</option>
                        @endforeach
                    </select>
                </div>
                

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Κλείσιμο</button>
            </div>
        </div>
    </div>
</div>