@extends('user.layout.app')
@section('title', 'Cart')
@section('content')
    <section>
        <header class="section-header">
            <p>Orders Item</p>
        </header>
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col md-8">
                    <table class="table table-responsive" id="myTable">
                        <thead>
                            <th>Id Transaction</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Date</th>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                            <tr>
                                <td>{{ $item->number }}</td>
                                <td>Rp{{ number_format($item->gross_amount , 0, ',', '.') }}</td>
                                <td>
                                    @if ($item->payment_status == 1)
                                    Menunggu pembayaran
                                    @elseif ($item->payment_status == 2)
                                    Sudah dibayar
                                    @elseif ($item->payment_status == 3)
                                    Kedaluwarsa
                                    @else
                                    Batal
                                    @endif
                                </td>
                                <td>
                                    {{ $item->created_at }}
                                </td>
                                @if ($item->payment_status == 1)
                                <td>
                                    <a href="{{ route('order.show', $item->id) }}">Bayar</a>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
