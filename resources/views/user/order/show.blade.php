@extends('user.layout.app')
@section('title', 'Cart')
@section('content')
    <section>
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col md-8">
                    <div class="card">
                        Order Details
                        {{-- @foreach ($order as $item) --}}
                        {{ $order->number }}
                        {{ $order->gross_amount }}
                        {{ $order->payment_status }}
                        {{-- @endforeach --}}
                    </div>
                    <button id="pay-button">Bayar sekarang</button>
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
