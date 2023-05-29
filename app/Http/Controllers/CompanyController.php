<?php

namespace App\Http\Controllers;

use App\Models\Resources\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create()
    {
        return view('resources.companies.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompanyRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCompanyRequest $request)
    {
        $validated = $request->validated();

        $company = new Company();
        $company->fill($validated);
        $company->save();

        return response()->json([
            'redirect' => route('aziende.show', $company->id),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resources\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    public function edit(Company $company)
    {
        return view('resources.companies.create_edit')
            ->with('company', $company);
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $validated = $request->validated();
        $company->update($validated);
        return response()->json([
            'redirect' => route('aziende.edit', $company->id),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resources\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}