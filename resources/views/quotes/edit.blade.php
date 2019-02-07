@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('forum.update',$quote->id) }}" method="POST">
        @csrf
        {{method_field('PATCH')}}
        <div class="form-grup">
            <label class="title">Judul</label>
            <input type="text" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }} " placeholder="Masukkan title" value="{{ old('title') ? old('title') : $quote->title }}">
            @if ($errors->has('title'))
                <span class="text-danger">{{ $errors->first('title') }}</span>
            @endif
        </div>
        <div class="form-grup">
            <label class="content">Isi kutipan</label>
            <textarea name="content" id="" cols="30" rows="10" class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}">{{ old('content') ? old('content') : $quote->content }}</textarea>
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
                            @foreach ($quote->tags as $oldTages)
                                <select class="form-control col-md-2 {{ session('tag_error') ? 'is-invalid' : '' }}" name="tags[]" id="tag_select">
                                    <option value="0">Tidak Ada</option>
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}" 
                                            @if ($oldTages->id === $tag->id)
                                                selected="selected"
                                            @endif 
                                        >{{ $tag->tag }}
                                        </option>
                                    @endforeach
                                </select>
                            @endforeach
                        </div>
                    </div>
                    @if (session('tag_error'))
                        <span class="text-danger">{{ session('tag_error') }}</span>
                    @endif
                </div>
                <script src="{{ asset('js/tag.js') }}" ></script>
            </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default btn-block" >Edit</button>
        </div>
    </form>
</div>
@endsection
