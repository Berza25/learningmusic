@extends('user.layout.app')
@section('title', 'Cart')
@section('content')
    <section>
        <header class="section-header">
            <p>Order Details</p>
        </header>
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col md-10">
                    <div class="card align-item-center">
                        <div class="card-header">
                            Order Details
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">ID Transaction</h5>
                            <p>{{ $order->number }}</p>
                            <h5 class="card-title">Total</h5>
                            <p>Rp{{ number_format($order->gross_amount , 0, ',', '.') }}</p>
                            <h5 class="card-title">Status</h5>
                            @if ($order->payment_status == 1)
                            Menunggu Pembayaran
                            @elseif ($order->payment_status == 2)
                            Sudah dibayar
                            @endif
                        </div>
                        <div class="card-footer">
                            <div class="card-text-right">
                                <button class="btn btn-success" id="pay-button">Bayar sekarang</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay('{{ $snapToken }}', {
        onSuccess: function(result){
            /* You may add your own implementation here */
            console.log(result);
            // send_response_to_form(result);
        },
        onPending: function(result){
            /* You may add your own implementation here */
            console.log(result);
            // send_response_to_form(result);
        },
        onError: function(result){
            /* You may add your own implementation here */
            console.log(result);
            // send_response_to_form(result);
        }
        })
    });
    </script>
@endpush
