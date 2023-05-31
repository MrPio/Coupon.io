<?php

namespace App\Http\Controllers;

use App\Http\Requests\FaqStoreRequest;
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
    public function store(FaqStoreRequest $request)
    {
        $validated = $request->validated();

        $faq = new Faq();
        $faq->fill($validated);
        $faq->save();

        return redirect()->route('faq.index')->with('success', 'Operazione avvenuta con successo');
    }

//
//
    public function edit($id)
    {
        $faq = Faq::find($id);
        if ($faq == null)
            abort(400);

        return view('resources.faqs.create_edit')
            ->with('faq', $faq);
    }


    public function update(FaqStoreRequest $request, Faq $faq)
    {
        $validated = $request->validated();
        $faq->update($validated);
        return response()->json([
            'redirect' => route('faqs.edit', $faq)
        ]);
    }

//
//    public function destroy($id)
//    {
//        //
//    }
}
