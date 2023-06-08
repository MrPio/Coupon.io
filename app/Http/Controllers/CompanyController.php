<?php

namespace App\Http\Controllers;

use App\Models\Resources\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CompanyController extends Controller
{
    public function index()
    {
        $is_staff = Auth::check() && Gate::allows('isStaff');
        $companies = ($is_staff && !Gate::allows('isPrivilegedStaff')) ?
            Auth::user()->staff->companies : Company::where('removed_at', null)->get();

        return view('resources.companies.index')
            ->with('companies', $companies);
    }

    public function create()
    {
        return view('resources.companies.create_edit');
    }

    public function store(StoreCompanyRequest $request)
    {
        $validated = $request->validated();

        $company = new Company();
        $company->fill($validated);

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $imageName = $logo->getClientOriginalName();
            $logo->move(public_path('images/aziende'), $imageName);
            $company->logo = $imageName;
        }

        $company->save();

        return response()->json([
            'status' => 'company-added',
            'redirect' => route('aziende.show', $company->id),
        ]);
    }

    public function show($id)
    {
        $company = Company::find($id);

        if ($company == null)
            abort(400);
        if (!$company->check())
            abort(403);

        return view('resources.companies.show')
            ->with('company', $company);
    }

    public function edit($id)
    {
        $company = Company::find($id);

        if ($company == null)
            abort(400);
        if (!$company->check())
            abort(403);

        return view('resources.companies.create_edit')
            ->with('company', $company);
    }

    public function update(UpdateCompanyRequest $request, $id)
    {
        $company = Company::find($id);
        if ($company == null)
            abort(400);
        if (!$company->check())
            abort(403);
        $validated = $request->validated();

        $company->update($validated);

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $imageName = $logo->getClientOriginalName();
            $logo->move(public_path('images/aziende'), $imageName);
            $company->logo = $imageName;
        } else {
            $imageName = null;
        }

        $company->save();

        return response()->json([
            'status' => 'company-modified',
            'color' => $company->color,
            'image' => $imageName,
            'redirect' => route('aziende.show', $company->id),
        ]);
    }

    public function destroy($id)
    {
        $company = Company::find($id);
        if ($company == null)
            abort(400);
        if (!$company->check())
            abort(403);
        $company->removed_at = date('Y-m-d', time());
        $company->save();
        return response()->json([
            'redirect' => route('aziende.show', $company->id),
        ]);
    }
}
