<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PageRequest;
use Illuminate\Support\Str;
use App\Models\DynamicPage;
use Exception;

class PageController extends Controller
{
    protected $pages;
    public function __construct(DynamicPage $pages)
    {
        $this->pages = $pages;
    }

    public function index()
    {
        $pages = $this->pages->all();
        return view('admin_Panel.page.index',compact('pages'));
    }


    public function create()
    {
        return view('admin_Panel.page.create');
    }


    public function store(PageRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['slug'] = Str::slug($validatedData['title']['en']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('admin_Assets/img/pages'), $fileName);
            $validatedData['image'] = '/admin_Assets/img/pages'.'/'.$fileName;
        }
        if (!is_array($validatedData['title'])) {
            $validatedData['title'] = [
                'en' => $validatedData['title']['en'],
                'np' => $validatedData['title']['np'],
            ];
        }
        if (!is_array($validatedData['content'])) {
            $validatedData['content'] = [
                'en' => $validatedData['content']['en'],
                'np' => $validatedData['content']['np'],
            ];
        }
        DynamicPage::create($validatedData);

        return redirect()->route('page.index')->with('message','Page & details created successfully!!!');
    }


    public function show($id)
    {
        //
    }


    public function edit($slug)
    {
        $page = $this->pages->where('slug', $slug)->first();

        return view('admin_Panel.page.edit',compact('page'));
    }


    public function update(PageRequest $request, $slug)
    {
        $validatedData = $request->validated();
        $validatedData['slug'] = Str::slug($validatedData['title']['en']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            if ($validatedData['image']) {
                $previousImagePath = public_path($validatedData['image']);
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }
            $file->move(public_path('admin_Assets/img/pages'), $fileName);
            $validatedData['image'] = '/admin_Assets/img/pages'.'/'.$fileName;
        }
        $validatedData['title'] = [
            'en' => $validatedData['title']['en'],
            'np' => $validatedData['title']['np'],
        ];
        $validatedData['content'] = [
            'en' => $validatedData['content']['en'],
            'np' => $validatedData['content']['np'],
        ];
        $page = $this->pages->where('slug', $slug)->first();
        $page->update($validatedData);

        return redirect()->route('page.index')->with('message','Page & contents update successfully!!!');
    }


    public function destroy($slug)
    {
        $page = $this->pages->where('slug', $slug)->first();
        if ($page->image) {
            $previousImagePath = public_path($page->image);
            if (file_exists($previousImagePath)) {
                unlink($previousImagePath);
            }
        }
        $page->delete();
        return redirect()->route('page.index')->with('message','Page & contents deleted successfully!!!');
    }
}
