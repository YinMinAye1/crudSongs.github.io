@extends('songs.layout')
@section('content')
    <div class="wrapperdiv">
        <div class="formcontainer">
            <div class="row">
                <div class="col-lg-12 margin-tb mb-3">
                    <div class="pull-left">
                        <h2>Edit Songs</h2>
                    </div>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Oops! There were some problems with your input</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('songs.update', $song->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-control mb-5">Title</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" id="title" class="form-control col-10"
                                    value="{{ $song->title }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="genre" class="col-sm-2 col-form-control mb-5">Genre</label>
                            <div class="col-sm-10">
                                <select name="genre" id="genre">
                                    <option value="">Select Genre</option>
                                    @if ($genres)
                                        @foreach ($genres as $genre)
                                            @if ($genre == $song->genre)
                                                <option value="{{ $genre }}" selected>{{ $genre }}</option>
                                            @else
                                                <option value="{{ $genre }}">{{ $genre }}</option>
                                            @endif
                                        @endforeach
                                    @endif


                                </select>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="release_year" class="col-sm-2 col-form-control mb-5">Release Year</label>
                            <div class="col-sm-10">
                                <input type="text" name="release_year" id="release_year" class="form-control col-10"
                                    value="{{ $song->release_year }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="poster" class="col-sm-2 col-form-control mb-5">Poster</label>
                            <div class="col-sm-10">
                                <input type="file" name="poster" id="poster" class="form-control-file col-10">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-2 mb-5"></div>
                            <div class="col-sm-10">
                                <button type="submit" name="submit" id="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection