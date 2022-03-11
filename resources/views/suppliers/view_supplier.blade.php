@extends('template')

@section('title', 'Στοιχεία προμηθευτή')

@section('content')
    <div class="container">
        <div class="card bg-success  bg-gradient shadow-lg border-0 rounded-3 mt-3 ">
            <div class="card-header">
                <h3 class="text-center font-weight-light my-2 ">{{ $supplier->company_name }}</h3>
            </div>
            <div class="card-body bg-light">
                <div class="row mt-3 justify-content-center">
                    <div class="col">
                        <div class="row">
                            <div class="col-4"><label>Ονομασία Εταιρείας</label></div>
                            <div class="col-8"><strong>{{ $supplier->company_name }}</strong></div>
                        </div>
                        <div class="row">
                            <div class="col-4"><label>Πωλητής/Εκπρόσωπος</label></div>
                            <div class="col-8"><strong>{{ $supplier->salesman ?: '-' }}</strong></div>
                        </div>
                        <div class="row">
                            <div class="col-4"><label>Ιστοσελίδα</label></div>
                            <div class="col-8"><a href="{{ $supplier->website }}"
                                    target="_blank">{{ $supplier->website }}</a></div>
                        </div>
                        <div class="row">
                            <div class="col-4"><label>E-mail</label></div>
                            <div class="col-8">
                                {{ $supplier->email }} . Aποστολή:
                                Yahoo -
                                <a style="color: rgb(0, 61, 202)"
                                    href="https://compose.mail.yahoo.com/?to={{ $supplier->email }}" target="_blank"><i
                                        class="fab fa-yahoo"></i></a>
                                , Gmail -
                                <a style="color: rgb(245, 18, 75)"
                                    href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $supplier->email }}"
                                    target="_blank"><i class="fab fa-google"></i></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4"><label>Τηλέφωνο 1</label></div>
                            <div class="col-8"><strong>{{ $supplier->phone1 ?: '-' }}</strong></div>
                        </div>
                        <div class="row">
                            <div class="col-4"><label>Τηλέφωνο 2</label></div>
                            <div class="col-8"><strong>{{ $supplier->phone2 ?: '-' }}</strong></div>
                        </div>
                        <div class="row">
                            <div class="col-4"><label>Διεύθυνση</label></div>
                            <div class="col-8">{{ $supplier->address ?: '-' }}</div>
                        </div>
                        <div class="row">
                            <div class="col-4"><label>T.K.</label></div>
                            <div class="col-8">{{ $supplier->zipcode ?: '-' }}</div>
                        </div>
                        <div class="row">
                            <div class="col-4"><label>Πόλη</label></div>
                            <div class="col-8">{{ $supplier->city ?: '-' }}</div>
                        </div>
                        <div class="row">
                            <div class="col-4"><label>ΑΦΜ</label></div>
                            <div class="col-8">{{ $supplier->afm ?: '-' }}</div>
                        </div>
                        <div class="row">
                            <div class="col-4"><label>Σημειώσεις ή παρατηρήσεις</label></div>
                            <div class="col-8"><textarea class="form-control"
                                    rows="2">{{ $supplier->description ?: '-' }}</textarea></div>
                        </div>
                    </div>
                    <div class="col">
                        <h5>Οικονομικά στοιχεία</h5>
                        <div class="row">
                            <div class="col-4"><label>Πλήθος τιμολογίων :</label></div>
                            <div class="col-8">{{ $invoice_count ?: '0' }}</div>
                        </div>
                        <div class="row">
                            <div class="col-4"><label>Σύνολο χρεώσεων :</label></div>
                            <div class="col-8">{{ $sum_charged . ' €' ?: '0 €' }}</div>
                        </div>
                        <div class="row">
                            <div class="col-4"><label>Σύνολο πληρωμών :</label></div>
                            <div class="col-8">{{ $paid . ' €' ?: '0 €' }}</div>
                        </div>
                        <div class="row">
                            <div class="col-4"><label>Υπόλοιπο :</label></div>
                            <div class="col-8"> <strong>{{ $new_balance ?: '0' }}</strong> €</div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-4"><label>Πειραιώς :</label></div>
                            <div class="col-8"> <strong>{{ $supplier->iban1 ?: '-' }}</strong></div>
                        </div>
                        <div class="row">
                            <div class="col-4"><label>Εθνική :</label></div>
                            <div class="col-8"> <strong>{{ $supplier->iban2 ?: '-' }}</strong></div>
                        </div>
                        <div class="row">
                            <div class="col-4"><label>Alpha :</label></div>
                            <div class="col-8"> <strong>{{ $supplier->iban3 ?: '-' }}</strong></div>
                        </div>
                        <div class="row">
                            <div class="col-4"><label>Eurobank :</label></div>
                            <div class="col-8"> <strong>{{ $supplier->iban4 ?: '-' }}</strong></div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="card-footer text-center py-2">
                <a href="javascript:history.back()" class="btn btn-info shadow-sm"> Επιστροφή </a>
            </div>
        </div>

        <div class="row mt-2">
            <h3>Καρτέλα συναλλαγών</h3>

            <table id="transactionsTable" class="cell-border display compact">
                <thead>
                    <tr>
                        <th>Ημερομηνία</th>
                        <th>Χρέωση</th>
                        <th>Πίστωση</th>
                        <th>Υπόλοιπο</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Ημερομηνία</th>
                        <th>Χρέωση</th>
                        <th>Πίστωση</th>
                        <th>Υπόλοιπο</th>
                    </tr>
                </tfoot>
                <tbody>
                    @php
                        $balance = $supplier->starting_balance;
                    @endphp
                @forelse ($table_stats as $transaction)
                    <tr>
                        <td>{{ $transaction->date->format('d-m-Y') }}</td>
                        <td>
                            @if($transaction->bank == null)
                                {{ number_format($transaction->amount,2,",",".") }}    
                                @php
                                    $balance += $transaction->amount;
                                @endphp
                            @endif
                        </td>
                        <td>
                            @if ($transaction->bank != null)
                                {{ number_format($transaction->amount,2,",",".") }}
                                @php
                                $balance -= $transaction->amount;
                                @endphp
                            @endif
                        </td>
                        <td>
                            {{ number_format($balance,2,",",".")}}

                        </td>
                    </tr>
                @empty
                    No transactions recorded in the database.
                @endforelse
                </tbody>
            </table>

        </div>
    </div>
    <script>
        $(document).ready( function () {
            $('#transactionsTable').DataTable({
                order: [0, 'asc'],
                paging: false,
                columnDefs: [{ 
                type: 'date-eu', targets: [0] }]
            });              
        });
    </script>
@endsection
