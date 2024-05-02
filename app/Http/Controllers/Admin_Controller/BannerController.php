<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    public function __construct(Banner $banners)
    {
        $this->banners = $banners;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = $this->banners->get();
        return view('admin_Panel.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_Panel.banner.create');
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
            'banner_title' => 'required|string',
            'banner_image' => ['required','image','mimes:jpeg,png,jpg,gif','max:3072'],
        ]);

        if ($request->hasFile('banner_image')) {
            $banner_image = $request->file('banner_image');
            $fileName = time().'.'.$banner_image->getClientOriginalExtension();
            $destinationPath = public_path('admin_Assets/img/banner');

            $banner_image->move($destinationPath, $fileName);
            $validatedData['banner_image'] = '/admin_Assets/img/banner'.'/'.$fileName;
        }
        $this->banners->create($validatedData);
        return redirect()->route('banner.index')->with('message','Banner Added Successfully!!!');
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
        $banner = $this->banners->where('id', $id)->first();
        return view('admin_Panel.banner.edit',compact('banner'));
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
            'banner_title' => 'nullable|string',
            'banner_image' => ['nullable','image','mimes:jpeg,png,jpg,gif','max:3072'],
        ]);

        if ($request->hasFile('banner_image')) {
            $banner_image = $request->file('banner_image');
            $fileName = time().'.'.$banner_image->getClientOriginalExtension();
            $destinationPath = public_path('admin_Assets/img/banner');

            if ($validatedData['banner_image']) {
                $previousImagePath = public_path($validatedData['banner_image']);
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }
            $banner_image->move($destinationPath, $fileName);
            $validatedData['banner_image'] = '/admin_Assets/img/banner'.'/'.$fileName;
        }
        $banner = $this->banners->where('id', $id)->first();
        $banner->update($validatedData);
        return redirect()->route('banner.index')->with('message','Banner Updated Successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = $this->banners->where('id', $id)->first();
        if ($banner['banner_image']) {
            $previousImagePath = public_path($banner['banner_image']);
            if (file_exists($previousImagePath)) {
                unlink($previousImagePath);
            }
        }
        $banner->delete();
        return redirect()->route('banner.index')->with('message','Banner Deleted Successfully!!!');
    }
}
