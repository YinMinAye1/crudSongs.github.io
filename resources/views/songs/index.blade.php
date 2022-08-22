@extends('songs.layout')
@section('content')
    <div class="wrapperdiv">

        @if ($message = Session::get('success'))
            <div class="alert alert-success text-center">{{ $message }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Title</th>
                    <th scope="col">Genre</th>
                    <th scope="col">Release Year</th>
                    <th scope="col"></th>
                </tr>

            </thead>
            @if ($songs)
                @foreach ($songs as $song)
                    <tbody>
                        <tr>
                            <td><img src="{{ asset('uploads/' . $song->poster) }}" class="img-thumbnail"></td>
                            <td class="align-middle">{{ $song->title }}</td>
                            <td class="align-middle">{{ $song->genre }}</td>
                            <td class="align-middle">{{ $song->release_year }}</td>
                            <td class="align-middle">
                                <form action="{{ route('songs.destroy', $song->id) }}" method="post">
                                    <a href="{{ route('songs.show', $song->id) }} " class="btn btn-info">Show</a>
                                    <a href="{{ route('songs.edit', $song->id) }}" class="btn btn-primary">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure want to delete?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                @endforeach
                </tbody>
            @endif

        </table>

        <div class="d-flex">
            <div class="mx-auto">
                {{ $songs->links('pagination::bootstrap-5') }}
            </div>
        </div>

    </div>
@endsection
