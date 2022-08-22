<?php

namespace App\Http\Controllers;

use App\Models\Songs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

use function Ramsey\Uuid\v1;

class SongsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $songs = Songs::latest()->paginate(4);
        return view('songs.index',compact('songs'))->with('i',(request()->input('page', 1) - 1) * 4 );
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = ['Pop','HipHop','Rock','R&B','Country','Dance','Jazz'];

        return view('songs.create' , compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate([
        'title'=>'required',
        'genre'=>'required',
        'release_year'=>'required',
        'poster'=>'required|image|mimes:png,jpg,jpeg.gif|max:2048',
       ]);

       $imgName = '';
        if ($request->poster) {
            $imgName = time() . '.' . $request->poster->extension();
            $request->poster->move(public_path('uploads'), $imgName);
        }

        $data = new Songs();
        $data->title = $request->title;
        $data->genre = $request->genre;
        $data->release_year = $request->release_year;
        $data->poster = $imgName;
        $data->save();
        return redirect()->route('songs.index')->with('success', 'Song has been added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Songs $song)
    {
        return view('songs.show',compact('song'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Songs $song)
    {
         $genres = ['Pop','HipHop','Rock','R&B','Country','Dance','Jazz'];
        return view('songs.edit', compact('song','genres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Songs $song)
    {
        $request->validate([
            'title'=>'required',
            'genre'=>'required',

        ]);

        $imgName = '';
        if ($request->poster) {
            $imgName = time() . '.' . $request->poster->extension();
            $request->poster->move(public_path('uploads'), $imgName);
            $song->poster = $imgName;
        }

        $song->title = $request->title;
        $song->genre = $request->genre;
        $song->release_year = $request->release_year;
        $song->update();
        return redirect()->route('songs.index')->with('success','Song has been updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function destroy($id)
    {
        Songs::destroy($id);

        return redirect()->route('songs.index')->with('success', 'Movie has been deleted successfully.');
    }
}
