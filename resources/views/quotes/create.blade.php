@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('quotes.store') }}" method="POST">
        @csrf
        <div class="form-grup">
            <label class="title">Judul</label>
            <input type="text" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }} " placeholder="Masukkan title" value="{{ old('title') }}">
            @if ($errors->has('title'))
                <span class="text-danger">{{ $errors->first('title') }}</span>
            @endif
        </div>
        <div class="form-grup">
            <label class="content">Isi kutipan</label>
            <textarea name="content" id="" cols="30" rows="10" class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}">{{ old('content') }}</textarea>
            @if ($errors->has('content'))
                <span class="text-danger">{{ $errors->first('content') }}</span>
            @endif
        </div>
        <br>
        <div class="form-group">
            <button type="submit" class="btn btn-default btn-block" >Save</button>
        </div>
    </form>
</div>
@endsection
