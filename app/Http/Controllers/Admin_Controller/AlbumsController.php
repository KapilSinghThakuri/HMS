<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AlbumCategory;

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
        return view('admin_Panel.gallery_album.view-album');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
