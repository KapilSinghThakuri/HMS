<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FAQ;

class FAQController extends Controller
{
    public function __construct(FAQ $faqs)
    {
        $this->faqs = $faqs;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = $this->faqs->get();
        return view('admin_Panel.FAQ.index',compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_Panel.FAQ.create');
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
            'subject' => 'required|string',
            'faq_question' => 'required|string',
            'faq_answer' => 'required',
        ]);
        $this->faqs->create($validatedData);
        return redirect()->route('faq.index')->with('message','New FAQ added successfully !!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $faq = $this->faqs->where('id', $id)->first();
        return view('admin_Panel.FAQ.faq-details',compact('faq'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faq = $this->faqs->where('id', $id)->first();
        return view('admin_Panel.FAQ.edit',compact('faq'));
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
            'subject' => 'required|string',
            'faq_question' => 'required|string',
            'faq_answer' => 'required',
        ]);
        $faq = $this->faqs->where('id', $id)->first();
        $faq->update($validatedData);
        return redirect()->route('faq.index')->with('message','New FAQ updated successfully !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faq = $this->faqs->where('id', $id)->first();
        $faq->delete($faq);
        return redirect()->route('faq.index')->with('message','New FAQ deleted successfully !!!');
    }
}
