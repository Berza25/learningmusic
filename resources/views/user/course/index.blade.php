@extends('user.layout.app')
@section('title', 'Courses')
@section('content')
<section class="blog" id="blog">
    <div class="container" data-aos="fade-up">
        <header class="section-header">
            <p>Course</p>
        </header>
        <div class="row">
            <div class="col-md-8">
                @foreach ($kelas as $itemk)
                <div class="card mb-3 shadow">
                    <div class="row g-0">
                        <div class="col-md-5">
                            <img src="{{ asset('materiimage/' . $itemk->image) }}" class="img-fluid rounded-start h-100 w-100">
                        </div>
                            <div class="col-md-7">
                                <div class="card-body">
                                <h4 class="card-title">{{ $itemk->title }}</h4>
                                <p class="card-text"><small>
                                    @if ($itemk->price->paid == 0)
                                    Free
                                    @else
                                        Rp{{ number_format($itemk->price->paid, 0, ',', '.') }}
                                    @endif
                                </small></p>
                                <p class="card-text"><small>{{ $itemk->level->grade }}</small></p>
                                <p class="d-flex align-items-center"><i class="bi bi-person"></i>
                                    <a href="{{ route('courses.show', $itemk->slug) }}">{{ $itemk->mycourse->count() }}
                                    Student</a>
                                </p>
                                <div class="d-flex justify-conten-center mb-4">
                                    @for ($star = 1; $star <= 5; $star++)
                                        @if ($itemk->rating >= $star)
                                            <i class="bi bi-star-fill"></i>
                                        @else
                                            <i class='bi bi-star'></i>
                                        @endif
                                    @endfor
                                </div>
                                <ul>
                                    <div class="d-flex justify-content-end">
                                        <a class="btn btn-primary" href="{{ route('courses.show', $itemk->slug) }}"> Read More</a>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="container py-3">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-sm-4">
                                <img src="{{ asset('materiimage/'. $itemk->image) }}" class="w-100 h-100">
                            </div>
                            <div class="col-md-8 px-3">
                                <div class="card-block px-3">
                                    <h4 class="card-title">Lorem ipsum dolor sit amet</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                @endforeach
                <ul class="pagination justify-content-center">
                    {{ $kelas->appends(request()->all())->links('vendor.pagination.bootstrap-4') }}
                </ul>

            </div>
            <div class="col-lg-4">
                <div class="sidebar">
                    <h3>Filters</h3>
                    <hr>
                    <form action="{{ route('courses.index') }}" method="get">
                        <h4 class="sidebar-title">Level</h4>
                        <div class="sidebar-item categories">
                            <ul>
                                @foreach ($lev as $level)
                                    <li><input type="radio" name="level" value="{{ $level->grade }}">
                                        {{ $level->grade }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- End sidebar categories-->
                        <h4 class="sidebar-title">Price</h4>
                        <div class="sidebar-item categories">
                            <ul>
                                @if (!auth()->check())
                                <li><input onclick="this.form.submit();" type="radio" name="price" value="paid">
                                    Paid</li>
                                @elseif (auth()->user()->role == 'murid' || auth()->user()->role == 'admin')
                                <li><input onclick="this.form.submit();" type="radio" name="price" value="free">
                                    Free</li>
                                <li><input onclick="this.form.submit();" type="radio" name="price" value="paid">
                                    Paid</li>
                                @else
                                <li><input onclick="this.form.submit();" type="radio" name="price" value="paid">
                                    Paid</li>
                                @endif
                            </ul>
                        </div>
                    </form>
                </div><!-- End sidebar -->
            </div>
        </div>
    </div>
</section>
@endsection
