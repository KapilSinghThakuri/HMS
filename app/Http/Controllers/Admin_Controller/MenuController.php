<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MenuRequest;
use App\Models\Menu;


class MenuController extends Controller
{
    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = $this->menu->get();
        return view('admin_Panel.menu.index',compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_Panel.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        $validatedData = $request->validated();
        // dd($validatedData);

        $validatedData['menu_name'] = [
            'en' => $validatedData['menu_name']['en'],
            'np' => $validatedData['menu_name']['np'],
        ];

        $parentMenu = $this->menu->create([
            'display_order' => $validatedData['display_order'],
            'menu_type_id' => $validatedData['menu_type_id'],
            'model_id' => $validatedData['model_id'],
            'page_id' => $validatedData['page_id'],
            'external_link' => $validatedData['external_link'],
            'menu_name' => $validatedData['menu_name'],
            'status' => $validatedData['status'],
        ]);

        // $validatedData['parent_id'] = $parentMenu->id;
        // $childMenu = $this->menu->create([
        //     'parent_id' => $validatedData['parent_id'],
        // ]);

        return redirect()->route('menu.index')->with('message','New Manu Item Added Successfully!!');
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
        $menu = $this->menu->where('id', $id)->first();
        return view('admin_Panel.menu.edit',compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, $id)
    {
        $validatedData = $request->validated();
        // dd($validatedData);

        $validatedData['menu_name'] = [
            'en' => $validatedData['menu_name']['en'],
            'np' => $validatedData['menu_name']['np'],
        ];

        $menu = $this->menu->where('id', $id)->first();
        $menu->update($validatedData);

        // $validatedData['parent_id'] = $parentMenu->id;
        // $childMenu = $menu->update([
        //     'parent_id' => $validatedData['parent_id'],
        // ]);
        return redirect()->route('menu.index')->with('message','The Manu Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = $this->menu->where('id', $id)->first();
        $menu->delete();
        return redirect()->route('menu.index')->with('message','The Manu Deleted Successfully!!');
    }
}
