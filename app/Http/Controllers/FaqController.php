<?php

namespace App\Http\Controllers;

use App\Models\Resources\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{

    public function index()
    {
        $faqs = Faq::all();

        return view('resources.faqs.index')
            ->with('faqs', $faqs);
    }

//
//    public function create()
//    {
//
//    }
//
//
//    public function store(Request $request)
//    {
//
//    }
//
//
//    public function show($id)
//    {
//
//    }
//
//
//    public function edit($id)
//    {
//        //
//    }
//
//    /
//    public function update(Request $request, $id)
//    {
//        //
//    }
//
//
//    public function destroy($id)
//    {
//        //
//    }
}
