@extends('user.layout.app')
@section('title', 'Courses')
@section('content')
    <div class="container" data-aos="fade-up">
        @foreach ($data as $item)
            <header class="section-header">
                <p>{{ $item->title }}</p>
            </header>
            <div class="row">
                <div class="col-lg-8">
                    <h1>Description</h1>
                    <p>{!! $item->description !!}</p>
                    <br>
                    <h4>Lesson</h4>
                    <div class="list-group">
                        @foreach ($item->lesson as $itemlesson)
                            @if (!empty($itemlesson->subject_matter))
                                <div class="list-group-item list-group-item-action" disabled><span class="fa fa-file"></span>
                                    {{ $itemlesson->title }}</div>
                            @endif
                            @if (!empty($itemlesson->embed_id))
                                <div class="list-group-item list-group-item-action" disabled><span class="fa fa-video"></span>
                                    {{ $itemlesson->title }}</div>
                            @endif
                        @endforeach
                    </div>
                    <br>
                    <h5>Comment</h5>
                    <form action="{{ route('course.comment') }}" method="POST">
                        @csrf
                        <textarea name="konten" class="form-control mb-2"></textarea>
                        <input type="hidden" name="course_id" value="{{ $item->id }}">
                        <input type="hidden" name="parent" value="0">
                        <input class="btn btn-primary" type="submit" value="Send">
                    </form>
                    <br>
                    <br>
                    <br>
                    <div class="py-2">
                        <div class="p-4">
                            <h4 class="text-center mb-4 pb-2">Comments Section</h4>
                            @foreach ($item->comment()->where('parent', 0)->orderBy('created_at', 'desc')->get() as $itemcomment)
                            <div class="d-flex flex-start m-2">
                                @if ($itemcomment->user->foto != null)
                                <img class="rounded-circle shadow-1-strong me-3" src="{{ asset('images/users/'. $itemcomment->user->foto) }}" alt="avatar" width="65" height="65" />
                                @else
                                <img class="rounded-circle shadow-1-strong me-3" src="{{ asset('images.png') }}" alt="avatar" width="65" height="65" />
                                @endif
                                <div class="flex-grow-1 flex-shrink-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="mb-1">
                                            {{ $itemcomment->user->name }} <span class="small">- {{ $itemcomment->created_at->diffForHumans() }}</span>
                                        </p>
                                        <div class="btn btn-komentar"><i class="fas fa-reply fa-xs"></i><span class="small">reply</span></div>
                                    </div>
                                    <p class="small mb-0">
                                        {{ $itemcomment->konten }}
                                    </p>
                                    @auth
                                        @if ($itemcomment->user->id == auth()->user()->id)
                                        <div class="d-flex">
                                            <button class="px-3 btn btneditkomutama" value="{{ $itemcomment->id }}"><i class="bi bi-pencil"> <small>Edit</small></i></button>
                                            <form action="{{route('comment.destroy', $itemcomment->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="btn"><i class="fa fa-trash"></i> <small>Hapus</small></button>
                                            </form>
                                            {{-- <a href=""><i class="bi bi-trash">Delete</i></a> --}}
                                        </div>
                                        <div class="edit-komentarutama mt-3" style="display: none;">
                                            <form action="{{ route('comment.update', $itemcomment->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <textarea name="konten" class="form-control mt-3">{{ $itemcomment->konten }}</textarea>
                                                <input type="submit" class="btn btn-primary mt-2" value="Update">
                                            </form>
                                        </div>
                                        @endif
                                    @endauth
                                    <div class="input-komentar" style="display: none;">
                                        <form action="{{ route('course.comment') }}" method="post">
                                            @csrf
                                            <textarea name="konten" class="form-control mt-2" ></textarea>
                                            <input type="hidden" name="course_id" value="{{ $item->id }}">
                                            <input type="hidden" name="parent" value="{{ $itemcomment->id }}">
                                            <input type="submit" class="btn btn-primary mt-2" value="Send">
                                        </form>
                                    </div>
                                    @foreach ($itemcomment->parents()->orderBy('created_at', 'desc')->get() as $parent)
                                    <div class="d-flex flex-start mt-4">
                                        @if ($parent->user->foto != null)
                                        <img class="rounded-circle shadow-1-strong me-3" src="{{ asset('images/users/'. $parent->user->foto) }}" alt="avatar" width="65" height="65" />
                                        @else
                                        <img class="rounded-circle shadow-1-strong me-3" src="{{ asset('images.png') }}" alt="avatar" width="65" height="65" />
                                        @endif
                                        <div class="flex-grow-1 flex-shrink-1">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="mb-1">
                                                    {{ $parent->user->name }} <span class="small">- {{ $parent->created_at->diffForHumans() }}</span>
                                                </p>
                                            </div>
                                            <p class="small mb-0">
                                                {{ $parent->konten }}
                                            </p>
                                            @auth
                                                @if ($parent->user->id == auth()->user()->id)
                                                <div class="d-flex">
                                                    <button class="px-3 btn btneditkom" value="{{ $parent->id }}"><i class="bi bi-pencil"> <small>Edit</small></i></button>
                                                    <form action="{{route('comment.destroy', $parent->id)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="btn"><i class="fa fa-trash"></i> <small>Hapus</small></button>
                                                    </form>
                                                    {{-- <a href=""><i class="bi bi-trash">Delete</i></a> --}}
                                                </div>
                                                <div class="edit-komentar mt-3" style="display: none;">
                                                    <form action="{{ route('comment.update', $parent->id) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <textarea name="konten" class="form-control mt-3">{{ $parent->konten }}</textarea>
                                                        <input type="submit" class="btn btn-primary mt-2" value="Update">
                                                    </form>
                                                </div>
                                                @endif
                                            @endauth
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <img src="{{ asset('materiimage/' . $item->image) }}" alt="" height="250">
                    @if ($item->price->paid == 0)
                    <h4>Free</h4>
                    @else
                    <h4 class="mt-2">Rp{{ number_format($item->price->paid, 0, ',', '.') }}</h4>
                    @endif
                    @if (auth()->check())
                        @if ($item->cart()->where('user_id', auth()->id())->where('status_cart', 'checkout')->where('course_id', $item->id)->count() == 1)
                            <a href="{{ route('lesson.user.show', $les->slug) }}" class="btn btn-primary">Start Lesson</a>
                        @elseif (!$item->cart()->where('user_id', auth()->id())->where('status_cart', 'cart')->where('course_id', $item->id)->count() == 1)
                            @if(auth()->user()->role == 'murid' || auth()->user()->role == 'admin' && $item->price->paid == 0)
                                @if($item->mycourse()->where('user_id', auth()->id())->where('course_id', $item->id)->count() == 1)
                                    <a href="{{ route('lesson.user.show', $les->slug) }}" class="btn btn-primary">Start Lesson</a>
                                @elseif($item->price->paid == 0)
                                <form action="{{ route('mycourse.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $item->id }}">
                                    <button type="submit" class="btn btn-primary">Enroll </button>
                                </form>
                                @else
                                <form action="{{ route('cart.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $item->id }}">
                                    <input type="hidden" name="total" value="{{ $item->price->paid }}">
                                    <button type="submit" class="btn btn-primary">Add to Cart </button>
                                </form>
                                @endif
                            @else
                            <form action="{{ route('cart.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="course_id" value="{{ $item->id }}">
                                <input type="hidden" name="total" value="{{ $item->price->paid }}">
                                <button type="submit" class="btn btn-primary">Add to Cart </button>
                            </form>
                            @endif
                        @else
                            <a href="{{ route('cart.index') }}" class="btn btn-primary">Added to Cart</a>
                        @endif
                    @else
                        <form action="{{ route('cart.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="course_id" value="{{ $item->id }}">
                            <input type="hidden" name="total" value="{{ $item->price->paid }}">
                            <button type="submit" class="btn btn-primary">Add to Cart </button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function(){
            $('.btn-komentar').click(function(){
                $('.input-komentar').toggle('slide')
            });
        });

        $(document).on("click", ".btneditkom", function()
            {
                $('.edit-komentar').toggle('slide')
                let id = $(this).val();
                $.ajax({
                    method: "get",
                    url :  "/course/comment/"+id+"/edit",
                }).done(function(response)
                {
                    $("#konten").val(response.konten);
                    $("#edit-komentar").attr("action", "/course/comment/" + id)
                });
            }
        );

        $(document).on("click", ".btneditkomutama", function()
            {
                $('.edit-komentarutama').toggle('slide')
                let id = $(this).val();
                $.ajax({
                    method: "get",
                    url :  "/course/comment/"+id+"/edit",
                }).done(function(response)
                {
                    $("#konten").val(response.konten);
                    $("#edit-komentar").attr("action", "/course/comment/" + id)
                });
            }
        );
    </script>
@endpush
