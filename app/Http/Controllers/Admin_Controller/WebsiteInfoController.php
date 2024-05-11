<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteInfoSettings;

class WebsiteInfoController extends Controller
{
    public function __construct(SiteInfoSettings $siteinfo)
    {
        $this->siteinfo = $siteinfo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siteinfos = $this->siteinfo->get();
        return view('admin_Panel.site_info_settings.index',compact('siteinfos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_Panel.site_info_settings.create');
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
            'info_type' => 'required|string',
            'label' => 'required|string',
            'value' => 'required|string',
            'icon' => 'nullable',
            'display_order' => 'required|numeric',
        ]);
        $this->siteinfo->create($validatedData);
        return redirect()->route('websiteinfo.index')->with('message', 'New '.$validatedData['label'].' added successfully!!');
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
        $siteinfo = $this->siteinfo->findOrFail($id);
        return view('admin_Panel.site_info_settings.edit',compact('siteinfo'));
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
            'info_type' => 'required|string',
            'label' => 'required|string',
            'value' => 'required|string',
            'icon' => 'nullable',
            'display_order' => 'required|numeric',
        ]);
        $siteinfo = $this->siteinfo->findOrFail($id);
        $siteinfo->update($validatedData);
        return redirect()->route('websiteinfo.index')->with('message', 'New '.$validatedData['label'].' updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siteinfo = $this->siteinfo->findOrFail($id);
        $siteinfo->delete();
        return redirect()->route('websiteinfo.index')->with('message', $siteinfo['label'].' info deleted successfully!!');
    }
}
