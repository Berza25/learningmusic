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
                <table class="table table-responsive">
                    <thead>
                        <th>
                            Item
                        </th>
                        <th>
                            Price
                        </th>
                        <th>
                            Action
                        </th>
                    </thead>
                    <tbody>
                        @forelse($carts as $item)
                        <tr>
                            <td>
                                {{ $item->course->title }}
                            </td>
                            <td>
                                {{ $item->total }}
                            </td>
                            <td>
                                <form action="{{route('cart.destroy', $item->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="dropdown-item btn"><i class="fa fa-trash"></i> Hapus</button>
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
            <div class="col-lg-4 text-center">
                <img src="{{ asset('materiimage/' . $item->course->image) }}" alt="" height="250">
                {{-- <form action="{{route('cart.checkout')}}" method="POST"> --}}
                    {{-- @csrf --}}
                    <button type="submit" class="btn btn-primary">Checkout</button>
                {{-- </form> --}}
            </div>
        </div>
    </div>
</section>
@endsection
