<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\GalleryRequest;
use App\Models\Gallery;


class GalleryController extends Controller
{
    public function __construct(Gallery $galleries)
    {
        $this->galleries = $galleries;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('admin_Assets/img/album-cover/photos');

            $file->move($destinationPath, $fileName);
            $validatedData['file'] = '/admin_Assets/img/album-cover/photos'.'/'.$fileName;
        }
        // dd($validatedData);
        $this->galleries->create($validatedData);
        return redirect()->back()->with('message', "New {$validatedData['file_type']} Added Successfully!!!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $photo = $this->galleries->where('id', $id)->first();
        if ($photo['file']) {
            $previousImagePath = public_path($photo['file']);
            if (file_exists($previousImagePath)) {
                unlink($previousImagePath);
            }
        }
        $photo->delete();
        return redirect()->back()->with('message', "Phot Deleted Successfully!!!");
    }
}
