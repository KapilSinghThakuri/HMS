<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AlbumCategory;
use App\Models\Gallery;

class AlbumsController extends Controller
{
    public function __construct(AlbumCategory $categories)
    {
        $this->categories = $categories;
    }

    public function index()
    {
        $categories = $this->categories->orderBy('display_order','asc')->get();
        return view('admin_Panel.gallery_album.albums',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_Panel.gallery_album.create-album');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'display_order' => ['required','numeric','min:1'],
            'album_title' => ['required','string', 'max:30'],
            'status' => ['required'],
            'album_cover' => ['nullable','image','mimes:jpeg,png,gif','max:2048'],
        ]);
        if ($request->hasFile('album_cover')) {
            $file = $request->file('album_cover');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('admin_Assets/img/album-cover');

            $file->move($destinationPath, $fileName);
            $validatedData['album_cover'] = '/admin_Assets/img/album-cover'.'/'.$fileName;
        }

        $this->categories->create($validatedData);
        return redirect()->route('album.index')->with('message','New Album Added Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $photos = Gallery::where('gallery_category_id', $id)->orderBy('display_order','asc')->get();
        return view('admin_Panel.gallery_album.view-album',compact('photos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $album = $this->categories->where('id',$id)->first();
        return view('admin_Panel.gallery_album.edit-album',compact('album'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'display_order' => ['required','numeric','min:1'],
            'album_title' => ['required','string', 'max:30'],
            'status' => ['required'],
            'album_cover' => ['nullable','image','mimes:jpeg,png,gif','max:2048'],
        ]);
        if ($request->hasFile('album_cover')) {
            $file = $request->file('album_cover');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('admin_Assets/img/album-cover');

            if ($validatedData['album_cover']) {
                $previousImagePath = public_path($validatedData['album_cover']);
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }

            $file->move($destinationPath, $fileName);
            $validatedData['album_cover'] = '/admin_Assets/img/album-cover'.'/'.$fileName;
        }
        $album = $this->categories->where('id',$id)->first();
        $album->update($validatedData);
        return redirect()->route('album.index')->with('message','New Album Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album = $this->categories->where('id',$id)->first();

        if ($album['album_cover']) {
            $previousImagePath = public_path($album['album_cover']);
            if (file_exists($previousImagePath)) {
                unlink($previousImagePath);
            }
        }
        $album->delete();
        return redirect()->route('album.index')->with('message','New Album Deleted Successfully!!');
    }
}
