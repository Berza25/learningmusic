@extends('user.layout.app')
@section('title', 'Courses')
@section('content')
<section>

    <div class="container" data-aos="fade-up">
        <header class="section-header">
            <p>Shopping Cart</p>
        </header>
        <div class="row">
            <div class="col-lg-8">
                <div class="card bg-grey">
                    <table class="table table-responsive table-borderless">
                        <thead>
                            <th class="text-center" colspan="2">
                                Item
                            </th>
                            <th class="text-center">
                                Price
                            </th>
                            <th class="text-center">
                                Action
                            </th>
                        </thead>
                        <tbody>
                            @forelse($carts as $item)
                            <tr>
                                <td align="center">
                                    <img src="{{ asset('materiimage/' . $item->course->image) }}" alt="" height="100">
                                </td>
                                <td align="left">
                                    {{ $item->course->title }}
                                </td>
                                <td align="center">
                                    Rp{{ number_format($item->total,0,',','.') }}
                                </td>
                                <td align="center">
                                    <form action="{{route('cart.destroy', $item->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="btn-primary btn-sm btn"> Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">
                                    Tidak Ada Item
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <div class="card pt-3">
                    <div class="card-body">
                        <div class="text-center">
                            <h3>Total Harga</h3>
                            <h4>Rp{{ number_format($item->sum('total'),0,',','.') }}</h4>
                        </div>
                        <button type="submit" class="btn btn-primary">Checkout</button>
                    </div>
                </div>
                {{-- <img src="{{ asset('materiimage/' . $item->course->image) }}" alt="" height="250"> --}}
                {{-- <form action="{{route('cart.checkout')}}" method="POST"> --}}
                    {{-- @csrf --}}
                {{-- </form> --}}
            </div>
        </div>
    </div>
</section>
@endsection
