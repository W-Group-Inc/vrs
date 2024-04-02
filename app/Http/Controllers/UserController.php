<?php

namespace App\Http\Controllers;
use App\User;
use App\Building;
use App\Tenant;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // List
    public function index()
    {   
        $users = User::all();
        $buildings = Building::all();
        return view('users.index', compact('users', 'buildings'));  
    }

    // Store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);
        
        try {
            
            $new_user = new User;
            $new_user->name = $request->name;
            $new_user->position = $request->position;
            $new_user->email = $request->email;
            $new_user->role = $request->role;
            $new_user->location = $request->location;
            $new_user->password = bcrypt($request->password);
            $new_user->save();

            return response()->json(['success' => true, 'message' => 'User created successfully!']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Error creating user.']);
        }
    }

    // Edit
    public function edit($id) 
    {
        $users = User::find($id);
        return view('users.edit', compact('user', 'tenants'));  
    }

    // Update
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($id),
            ],
            'role' => 'required|string|max:255',
        ]);
        
        try {
            
            $update_user = User::find($id);
            $update_user->name = $request->input('name');
            $update_user->position = $request->input('position');
            $update_user->email = $request->input('email');
            $update_user->role = $request->input('role');
            $update_user->location = $request->input('location');
            $update_user->update();

            return response()->json(['success' => true, 'message' => 'User updated successfully!']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Error creating user.']);
        }
    }

    // Delete
    public function delete($id)
    {
        $users = User::find($id);
        if ($users) {
            $users->delete();
            Alert::success('Success Title', 'Success Message');
        } else {
            Alert::error('Error Title', 'Record not found');
        }

        return back();        
    }

}
