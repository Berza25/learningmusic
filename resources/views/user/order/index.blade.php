@extends('user.layout.app')
@section('title', 'Cart')
@section('content')
    <section>
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col md-8">
                    <div class="card-head">
                        Order Details
                    </div>
                    <div class="card">
                        @foreach ($orders as $item)
                        {{ $item->number }}
                        {{-- {{ $item->user->name }} --}}
                        Rp{{ $item->gross_amount }}
                        @if ($item->payment_status == 1)
                        Menunggu pembayaran
                        @endif
                        {{ $item->created_at }}
                        @if ($item->payment_status == 1)
                        <a href="{{ route('order.show', $item->id) }}">Bayar</a>
                        @else
                        pemayaran berhasil
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
