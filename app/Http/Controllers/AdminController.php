<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Contracts\Role;

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

    public function AdminLogin()
    {
        return view('admin.admin_login');
    }
    public function AdminProfile()
    {
        $id  = Auth::user()->id;
        $adminUser = User::find($id);

        return view('admin.admin_profile_view', compact('adminUser'));
    }
    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->phone = $request->phone;

        if ($request->file('photo')) {

            $file = $request->file('photo');

            @unlink(public_path('upload/admin_image/' . $data->photo));
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/admin_image'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    //AdminChangePassword
    public function AdminChangePassword()
    {
        $id = Auth::user()->id;
        $adminUser = User::find($id);

        return view('admin.admin_change_password', compact('adminUser'));
    }

    public function AdminUpdatePassword(Request $request)
    {

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        //match old password

        if (!Hash::check($request->old_password, Auth::user()->password)) {
            $notification = array(
                'message' => 'Old Passwoed does not match',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        // Updeted password

        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        $notification = array(
            'message' => 'Password change successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    //allAdmin
    public function allAdmin()
    {

        $alladmin = User::where('role', 'admin')->get();

        return view('backend.pages.admin.all_admin', compact('alladmin'));
    }
}
