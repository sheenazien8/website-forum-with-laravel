@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('quotes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="title">Judul</label>
            <input type="text" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }} " placeholder="Masukkan title" value="{{ old('title') }}">
            @if ($errors->has('title'))
                <span class="text-danger">{{ $errors->first('title') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label class="content">Isi kutipan</label>
            <textarea name="content" id="" cols="30" rows="10" class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}">{{ old('content') }}</textarea>
            @if ($errors->has('content'))
                <span class="text-danger">{{ $errors->first('content') }}</span>
            @endif
        </div>
        <br>
        <div id="wrapper">
            <div class="form-group">
                <label for="">Tag (maksimal 3)</label>
                <button class="btn btn-default" id="add_tag">Add Tag</button>
                <div class="col-md-12">
                    <div class="row" id="wrap">
                        <select class="form-control col-md-2" name="tags[]" id="tag_select">
                            <option value="0">Tidak Ada</option>
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->tag }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
            <script>
                $(document).ready(function() {
                    var counter = 0;
                    $("#add_tag").on('click', function(event) {
                        event.preventDefault();
                        /* Act on the event */
                        counter++
                        if (counter < 3) {
                            $("#tag_select").clone().appendTo("#wrap")
                        }
                    });
                });
            </script>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block" >Save</button>
        </div>
    </form>
</div>
@endsection
