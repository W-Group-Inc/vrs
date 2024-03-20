<?php

namespace App\Http\Controllers;
use App\Building;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BuildingController extends Controller
{
    // List
    public function index()
    {   
        $buildings = Building::all();
        return view('buildings.index', compact('buildings'));  
    }

    // Store 
    public function store(Request $request)
    {
        $new_building = new Building;
        $new_building->name = $request->name;
        $new_building->address = $request->address;
        $new_building->save();
        Alert::success('Success Title', 'Success Message');
        return back();
    }   

    // Edit
    public function edit($id)
    {
        $buildings = Building::find($id);
        return view('buildings.edit', compact('buildings'));
    }

    // Update 
    public function update(Request $request, $id) 
    {
        $buildings = Building::find($id);
        $buildings->name = $request->input('name');
        $buildings->address = $request->input('address');
        $buildings->update();
        Alert::success('Success Title', 'Success Message');
        return back();
    }

    // Delete
    public function delete($id) 
    {
        $building = Building::find($id);
        if ($building) {
            $building->delete();
            Alert::success('Success Title', 'Success Message');
        } else {
            Alert::error('Error Title', 'Record not found');
        }

        return back(); 
    }
}
