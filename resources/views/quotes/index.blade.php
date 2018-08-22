@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('msg'))
        <div class="alert alert-success">
            <p>{{ session('msg') }}</p>
        </div>
    @endif
    <div class="row">
        @foreach ($quotes as $quote)
            <div class="col-md-4">
                <div class="thumnail">
                    <div class="caption">
                        <div>{{ $quote->title }}</div>
                        <p><a href="/quotes/{{ $quote->slug }}" class="btn btn-warning">Lihat Quotes</a></p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
