@extends('songs.layout')
@section('content')
    <div class="wrapperdiv">
        @if ($song)
            <div class="row pb-5">
                <div class="col-4"></div>
                <div class="col-4">
                    <div class="card" style="width: 20rem;">
                        <img src="{{ asset('uploads/'.$song->poster) }}" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{{ $song->title }}</h5>
                            <p class="card-text">{{ $song->genre }} | {{ $song->release_year }}</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-4"></div>
            </div>
        @endif
    </div>
@endsection
