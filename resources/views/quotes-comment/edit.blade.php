@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('comments.update',$comment->id) }}" method="POST">
        @csrf
        {{method_field('PATCH')}}
        <div class="form-grup">
            <label class="title">Edit komentar</label>
            <input type="text" name="comment" class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }} " placeholder="Masukkan comment" value="{{ old('comment') ? old('comment') : $comment->comment }}">
            @if ($errors->has('comment'))
                <span class="text-danger">{{ $errors->first('comment') }}</span>
            @endif
        </div>
        <br>
        <div class="form-group">
            <button type="submit" class="btn btn-default btn-block" >Edit</button>
        </div>
    </form>
</div>
@endsection
