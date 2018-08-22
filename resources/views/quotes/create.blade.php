@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('quotes.store') }}" method="POST">
        @csrf
        <div class="form-grup">
            <label class="title">Judul</label>
            <input type="text" name="title" class="form-control" placeholder="Masukkan title">
        </div>
        <div class="form-grup">
            <label class="content">Isi kutipan</label>
            <textarea name="content" id="" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <br>
        <div class="form-group">
            <button type="submit" class="btn btn-default" >Save</button>
        </div>
    </form>
</div>
@endsection
