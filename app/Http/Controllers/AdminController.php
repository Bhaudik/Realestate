<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function AdminDashboard()
    {
        return view("admin.index");
    }

    public function AdminLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('admin/login');
    }

    public function AdminLogin(){
        return view('admin.admin_login');
    }
    public function AdminProfile(){
        $id  = Auth::user()->id;
        $adminUser = User::find($id);

        return view('admin.admin_profile_view', compact('adminUser'));
    }
    public function AdminProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->phone = $request->phone;

        if($request->file('photo')){

            $file = $request->file('photo');

            $filename = time() .'.'. $file->getClientOriginalExtension();
            $file->move(public_path('upload/admin_image'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        return redirect()->back();
    }

        
        
}
