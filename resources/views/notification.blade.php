@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Halaman Notifikasi<em></em></h1>
            <h3>List Forum </h3>
            <ul class="list-group">
                @foreach ($notifications as $notif)
                    <li class="list-group-item"><a href="{{ route('quotes.show', $notif->quote->slug) }}">{{ $notif->subject." di ".$notif->quote->title }}</a></li>
                @endforeach
            </ul>
        </div>
        @php
            $notif_model::where('user_id',$user->id)->where('seen', 0)->update(['seen' => 1]);
        @endphp
    </div>
</div>
@endsection
