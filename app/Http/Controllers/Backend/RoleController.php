<?php

namespace App\Http\Controllers\Backend;

use App\Exports\PermissionExport;
use App\Http\Controllers\Controller;
use App\Imports\PermissionImport;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
// use Illuminate\Support\Facades\DB;
use DB;

class RoleController extends Controller
{

    public function AllPermission()
    {
        $permission = Permission::all();

        return view("backend.pages.permission.all_permission", compact('permission'));
    }

    public function AddPermission(Request $request)
    {

        return view('backend.pages.permission.add_permission');
    }

    public function storePermission(Request $request)
    {

        //validation


        $permission = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);


        $notification = array(
            'message' => 'Permission Creted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.permission')->with($notification);
    }
    public function EditPermission($id)
    {

        $permission = Permission::find($id);
        return view('backend.pages.permission.edit_permission', compact('permission'));
    }

    public function updatePermission(Request $request)
    {
        $pid = $request->id;

        Permission::findOrFail($pid)->update([
            'name' => $request->name,
            'group_name' => $request->group_name
        ]);
        // dd($request->all());

        $notification = array(
            'message' => 'Permission Update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.permission')->with($notification);
    }

    public function DeletePermission($id)
    {

        Permission::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Permission Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function importPermissionsView()
    {
        return view('backend.pages.permission.import_permission');
    }

    public function importPermissions(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new PermissionImport, $request->file('file'));

        return redirect()->route('all.permission')->with('success', 'Permissions imported successfully!');
    }
    // app/Http/Controllers/RoleController.php

    public function exportPermissions()
    {
        return Excel::download(new PermissionExport, 'permissions.csv', \Maatwebsite\Excel\Excel::CSV);
    }


    /**
     * /All Role Funcrion 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function AllRoles()
    {
        $roles = Role::all();

        return view('backend.pages.roles.all_roles', compact('roles'));
    }

    public function AddRoles(Request $request)
    {
        return view('backend.pages.roles.add_roles');
    }

    public function storeRoles(Request $request)
    {
        // Validation (only name required)
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Storing Role
        Role::create([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Role Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles')->with($notification);
    }

    public function EditRoles($id)
    {
        $roles = Role::find($id);
        return view('backend.pages.roles.edit_roles', compact('roles'));
    }

    public function updateRoles(Request $request)
    {
        $roleId = $request->id;

        // Validation (only name required)
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Update Role
        Role::findOrFail($roleId)->update([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Role Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles')->with($notification);
    }

    public function DeleteRoles($id)
    {
        Role::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Role Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * add all role and pemistion 
     * 
     */
    public function AddRolesPermission()
    {
        $roles = Role::all();
        $permission = Permission::all();
        $permission_group = User::getPermissionGroup();
        return view('backend.pages.rolesetup.add_roles_permission', compact('roles', 'permission', 'permission_group'));
    }


    public function RolePermissionStore(Request $request)
    {

        // dd($request->all());
        $data = array();
        $permissions = $request->permissions;

        foreach ($permissions as $key => $value) {
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $value;

            DB::table('role_has_permissions')->insert($data);
        }
        $notification = array(
            'message' => 'Role Premission Added Successfully',
            'alter-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function allRolePermission()
    {
        $roles = Role::all();
        $permission = Permission::all();

        return view('backend.pages.permission.all_roles_permission', compact('roles', 'permission'));
    }
}
