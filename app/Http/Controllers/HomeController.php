<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Visitor;
use App\Tenant;
use App\Building;
use Illuminate\Support\Facades\Hash;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $visitors = Visitor::all(); 
        $buildings = Building::all();
        return view('dashboard.index', compact('visitors', 'buildings')); 
    }

    public function changePassword()
    {
        return view('layouts.change_password');
    }
    
    public function updatePassword(Request $request)
    {   
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);

        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Old password doesn't match!");
        }
           
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
    }
}
