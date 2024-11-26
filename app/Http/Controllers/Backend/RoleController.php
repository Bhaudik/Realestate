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
use Illuminate\Support\Facades\Hash;

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

        return view('backend.pages.rolesetup.all_roles_permission', compact('roles', 'permission'));
    }

    public function AdminEditRole($id)
    {

        $roles = Role::findOrFail($id);
        $permissions = Permission::all();
        $permission_group = User::getPermissionGroup();

        return view('backend.pages.rolesetup.edit_role_permission', compact('roles', 'permissions', 'permission_group'));
    }

    // public function AdminRolesUpdates(Request $request, $id)
    // {

    //     // dd($request->all());
    //     $role = Role::findOrFail($id);
    //     $permissions = $request->permission;

    //     if (!empty($permissions)) {
    //         $role->syncPermissions($permissions);
    //     }
    //     $notification = array(
    //         'message' => 'Role Premission Updeted Successfully',
    //         'alter-type' => 'success'
    //     );
    //     return redirect()->route('all.roles.permission')->with($notification);
    // }

    public function AdminRolesUpdates(Request $request, $id)
    {
        // Fetch the role
        $roles = Role::findOrFail($id);

        // Extract and validate permissions from the request
        $permissions = $request->permission;

        if (!empty($permissions)) {
            // Ensure permissions are valid names
            $permissionNames = Permission::whereIn('id', $permissions)->pluck('name')->toArray();

            // Sync permissions with the role
            $roles->syncPermissions($permissionNames);
        } else {
            $roles->syncPermissions([]);
        }


        // Create a success notification
        $notification = [
            'message' => 'Role Permissions Updated Successfully',
            'alert-type' => 'success',
        ];

        // Redirect back to the roles page
        return redirect()->route('all.roles.permission')->with($notification);
    }

    public function AdminRolesDelete($id)
    {

        $roles = Role::findOrFail($id);
        if (!is_null($roles)) {
            $roles->delete();
        }

        $notification = [
            'message' => 'Role Permissions Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function addAdmin()
    {
        $roles = Role::all();

        return view('backend.pages.admin.add_admin', compact('roles'));
    }

    //add addmin

    public function storeAdmin(Request $request)
    {
        // Validate and process the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'roles' => 'required|exists:roles,id', // Validate that the role exists in the roles table
        ]);

        // Save the user
        $user = new User();
        $user->name = $validatedData['name'];
        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->phone = $validatedData['phone'] ?? null;
        $user->address = $validatedData['address'] ?? null;
        $user->role = 'admin'; // Default role assignment
        $user->status = 'active';
        $user->save();

        // Assign role to the user
        if ($request->roles) {
            $role = Role::find($request->roles); // Retrieve the role by ID
            if ($role) {
                $user->assignRole($role->name); // Assign the role by name
            } else {
                return redirect()->back()->withErrors(['roles' => 'The selected role is invalid.']);
            }
        }

        // Notification
        $notification = [
            'message' => 'New Admin added successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.admin')->with($notification);
    }

    public function editAdmin($id)
    {
        $user = User::find($id);
        $roles  = Role::all();

        return view('backend.pages.admin.edit_admin', compact('user', 'roles'));
    }
    public function updateAdmin(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'roles' => 'required|exists:roles,id', // Validate that the role exists in the roles table
        ]);
        $user->name = $validatedData['name'];
        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        $user->phone = $validatedData['phone'] ?? null;
        $user->address = $validatedData['address'] ?? null;
        $user->role = 'admin'; // Default role assignment
        $user->status = 'active';
        $user->save();

        $user->roles()->detach();
        if ($request->roles) {
            $role = Role::find($request->roles); // Retrieve the role by ID
            if ($role) {
                $user->assignRole($role->name); // Assign the role by name
            } else {
                return redirect()->back()->withErrors(['roles' => 'The selected role is invalid.']);
            }
        }

        // Notification
        $notification = [
            'message' => 'Admin Updated successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.admin')->with($notification);
    }

    public function AdminDelete($id)
    {

        $user = User::findOrFail($id);
        if (!is_null($user)) {
            $user->delete();
        }

        $notification = [
            'message' => 'User Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }
}
