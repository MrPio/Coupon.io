<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffUpdateRequest;
use App\Models\Resources\Account;
use App\Models\Resources\Company;
use App\Models\Resources\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreStaffRequest;

class StaffController extends Controller
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
        return view('resources.staff.create_edit')
            ->with('companies_name', Company::getNamesAssignableToStaff());
    }

    public function store(StoreStaffRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        $account = new Account();
        $account->fill($validated);
        $account->save();

        Staff::create([
            'id' => $account->id
        ]);

        foreach ($request->companies as $company_id){
            $data = [
                'company_id' => $company_id,
                'staff_id' => $account->id
            ];
            DB::table('company_staff')->insert($data);
        }

        if ($request->privileged !== null){
            if ($request->privileged == "1"){
                $privileged_staff = Staff::where('privileged', true)->first();
                if ($privileged_staff !== null){
                    $privileged_staff->privileged = false;
                    $privileged_staff->save();
                }
                $staff = Staff::find($account->id);
                $staff->privileged = true;
                $staff->save();
            }
        }

        return response()->json([
            'status' => 'staff-added'
        ]);
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

    public function edit(Staff $staff)
    {
        return view('resources.staff.create_edit')
            ->with('staff', $staff)
            ->with('companies_name', Company::getNamesAssignableToStaff());
    }

    public function update(StaffUpdateRequest $request, $id)
    {
        $validated = $request->validated();
        if ($request->has('password')) {
            if (isset($request->password) && !empty($request->password)) {
                $validated['password'] = Hash::make($validated['password']);
            } else {
                unset($validated['password']);
            }
        }

        $staff = Staff::find($id);
        $staff->account->update($validated);
        $has_all_companies = false;

        if ($request->has('privileged')){
            if ($request->privileged == 1){
                DB::table('company_staff')->where('staff_id', $staff->id)->delete();
                $has_all_companies = true;
                foreach (Company::getIdsAssignableToStaff() as $company_id){
                    $data = [
                        'company_id' => $company_id,
                        'staff_id' => $staff->id
                    ];
                    DB::table('company_staff')->insert($data);
                }
            }
            else{
                $staff->update($validated);
            }
        }

        if ($request->has('companies') && !$has_all_companies){
            if (isset($request->companies) && !empty($request->companies)){
                DB::table('company_staff')->where('staff_id', $staff->id)->delete();

                foreach ($request->companies as $company_id){
                    $data = [
                        'company_id' => $company_id,
                        'staff_id' => $staff->id
                    ];
                    DB::table('company_staff')->insert($data);
                }
            }
        }

        if ($request->privileged !== null){
            if ($request->privileged == 1){
                $privileged_staff = Staff::where('privileged', true)->first();
                if ($privileged_staff !== null){
                    $privileged_staff->privileged = false;
                    $privileged_staff->save();
                }
                $staff->privileged = true;
                $staff->save();
            }
        }
        return response()->json([
            'status' => 'staff-modified'
        ]);
    }

    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        $staff?->delete();
    }
}
