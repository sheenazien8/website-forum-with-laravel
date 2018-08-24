@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('msg'))
        <div class="alert alert-success">
            <p>{{ session('msg') }}</p>
        </div>
    @endif
    <div class="row mb-4">
        <div class="col-md-4">
            <form class="form-inline" action="{{ route('quotes.index') }}">
                <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            Filter Tag:
            @foreach ($tags as $tag)
                <a href="{{ route('quotes.filtag', $tag->tag) }}">{{ $tag->tag }}/</a>
            @endforeach
        </div>
        <div class="col-md-6">
            <a href="{{ route('quotes.index') }}" class="btn btn-primary mr-2">All</a>
            <a href="{{ route('quotes.random') }}" class="btn btn-primary mr-2">Random</a>
            <a href="{{ route('quotes.create') }}" class="btn btn-primary">Create Question</a>
        </div>
    </div>
    <div class="row">
        @foreach ($quotes as $quote)
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ $quote->title }}</h3>
                    </div>
                    <div class="card-body">
                        <p>{{ substr($quote->content, 0, 200) }}<a href="/quotes/{{ $quote->slug }}">readmore</a></p>
                    </div>
                    <div class="card-footer">
                        <p class="text-primary">
                            tag:
                            @foreach ($quote->tags as $tag)
                                #{{ $tag->tag }}
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
