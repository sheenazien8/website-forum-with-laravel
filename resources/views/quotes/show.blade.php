@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <h1 class="display-4">{{ $quote->title }}</h1>
                <p class="lead">{{ $quote->content }}</p>
                <span>ditulis oleh <em><a href="{{ route('profile',$quote->user->id) }}">{{ $quote->user->name }}</a></em></span>
                <div class="col-md-12">
                    <a href="/quotes" class="btn btn-primary">balik kedaftar</a>
                    {{-- Cek apakah user yang melihat itu user yang membuat id ini? --}}
                    @if ($quote->isOwner())
                        <form action="{{ route('quotes.destroy',$quote->id) }}" method="POST" class="col-md-2">
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
            @foreach ($quote->comments as $comment)
                <p>ditulis oleh <em><a href="{{ route('profile',$comment->user->id) }}">{{ $comment->user->name }}</a></em></p>
                <p>{{ $comment->comment }}</p>
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
