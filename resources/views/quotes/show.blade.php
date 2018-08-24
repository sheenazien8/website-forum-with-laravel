@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <h1 class="display-4">{{ $quote->title }}</h1>
                <p class="lead">{{ $quote->content }}</p>
                <span>ditulis oleh <em><a href="{{ route('profile',$quote->user->id) }}">{{ $quote->user->name }}</a></em></span>
                <p class="lead text-primary">
                    @foreach ($quote->tags as $tag)
                        #{{ $tag->tag }}
                    @endforeach
                </p>
                <div class="row col-md-12">
                    <a href="/quotes" class="btn btn-primary mr-2">balik kedaftar</a>
                    <div class="like-wrapper">
                        <div class="btn btn-light btn-like mr-2" data-type="1" data-model-id="{{ $quote->id }}">Like</div>
                        <span class="btn mr-2" id="total_like">0</span>
                    </div>
                    {{-- Cek apakah user yang melihat itu user yang membuat id ini? --}}
                    @if ($quote->isOwner())
                        <form action="{{ route('quotes.destroy',$quote->id) }}" method="POST" class="mr-2">
                            @csrf
                            {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-danger" >Delete</button>
                        </form>
                        <a href="{{ route('quotes.edit',$quote->id)}}" class="btn btn-warning">edit</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if (session('msg'))
                <div class="alert alert-success">
                    <p>{{ session('msg') }}</p>
                </div>
            @endif
            @foreach ($quote->comments as $comment)
            <div class="row">
                <div class="col-md-6">
                    <p>ditulis oleh <em><a href="{{ route('profile',$comment->user->id) }}">{{ $comment->user->name }}</a></em></p>
                    <p>{{ $comment->comment }}</p>
                </div>
                    @if ($comment->isOwner())
                    <div class="col-md-2">
                        <form action="{{ route('comments.destroy',$comment->id) }}" method="POST">
                            @csrf
                            {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('comments.edit',$comment->id)}}" class="btn btn-warning">edit</a>
                    </div>
                    @else
                    <div class="col-md-2">
                        <div class="like-wrapper">
                            <div data-type="2" data-model-id="{{ $comment->id }}" class="btn btn-light btn-like">like</div>
                            <span class="btn" id="total_like">0</span>
                        </div>
                    </div>
                    @endif

            </div>
                <hr>
            @endforeach
            <form action="{{ route('comments.store', $quote->id) }}" method="POST">
                @csrf
                <div class="form-grup">
                    <label class="content">Isi Komentar</label>
                    <textarea name="comment" id="" class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}">{{ old('comment') }}</textarea>
                    @if ($errors->has('comment'))
                        <span class="text-danger">{{ $errors->first('comment') }}</span>
                    @endif
                </div>
                <br>
                <div class="form-group">
                    <button type="submit" class="btn btn-default" >Comment</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).on('click touchStar', '.btn-like', function(event) {
            event.preventDefault();
            /* Act on the event */
            var _this = $(this)

            var _url = '/like/'+_this.attr('data-type')+"/"+_this.attr('data-model-id');
            console.log(_url)
            $.get(_url, function(data) {
                _this.removeClass('btn-light').addClass('btn-danger').html('Unlike')
                var likeNumber = _this.parents('.like-wrapper').find('#total_like')
                likeNumber.html(parseInt(likeNumber.html()) + 1)
            });
        });
    </script>
@endsection