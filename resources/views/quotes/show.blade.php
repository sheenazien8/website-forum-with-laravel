@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
            <div class="jumbroton">
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
@endsection
