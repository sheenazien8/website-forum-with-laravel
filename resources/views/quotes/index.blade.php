@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('msg'))
        <div class="alert alert-success">
            <p>{{ session('msg') }}</p>
        </div>
    @endif
    <div class="col-md-12 text-center">
        <a href="{{ route('quotes.random') }}" class="btn btn-primary">Random</a>
        <a href="{{ route('quotes.create') }}" class="btn btn-primary">Create Quotes</a>
    </div>
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
