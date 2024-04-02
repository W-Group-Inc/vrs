<?php

namespace App\Http\Controllers;
use App\Tenant;
use App\Building;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TenantController extends Controller
{
    // List
    public function index()
    {   
        $buildings = Building::all();
        $tenants = Tenant::all();
        return view('tenants.index', compact('buildings', 'tenants'));
    }

    // Store
    public function store(Request $request) 
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'building_id' => 'required|string|max:255',
        ]);
        
        try {

            $new_tenant = new Tenant;
            $new_tenant->name = $request->name;
            $new_tenant->building_id = $request->building_id;
            $new_tenant->save();
    
            return response()->json(['success' => true, 'message' => 'Tenant created successfully!']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Error creating tenant.']);
        }
    }

    // Edit
    public function edit($id)
    {
        $tenants = Tenant::find($id);
        $buildings = Building::all();
        return view('tenants.edit', compact('tenants', 'buildings'));
    }

    // Update
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $tenants = Tenant::find($id);
        $tenants->name = $request->input('name');
        $tenants->building_id = $request->input('building_id');
        $tenants->update();
        Alert::success('Success Title', 'Success Message');
        return back();
    }

    // Delete
    public function delete($id)
    {
        $tenant = Tenant::find($id);
        if ($tenant) {
            $tenant->delete();
            Alert::success('Success Title', 'Success Message');
        } else {
            Alert::error('Error Title', 'Record not found');
        }

        return back(); 
    }
}
