<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Inside\Helpers;
use App\Inside\PrivilegedProfiles;
use App\Inside\PrivilegedUsers;
use App\Permission;
use App\Role_Permissions;
use App\Role;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class RolesController extends Controller
{
    protected $help;

    function __construct()
    {
        $this->help = new Helpers();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->help->checkPermission(Auth::user()->id, "roles-manage");
        $data['rolesInfo'] = Role::paginate(10);

        foreach ($data['rolesInfo'] as $key => $value) {
            $permissions = DB::table('role_permissions as rp')
                ->where('role_id', $value->id)
                ->join('permissions as p', 'p.id', '=', 'rp.permission_id')->get();

            foreach ($permissions as $per)
                $value->permissions .= $per->route_name . ' ';
        }
        $data['active'] = 'all';

        return view('admin.roles.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->help->checkPermission(Auth::user()->id, "roles-manage");
        $data['permissionsInfo'] = Permission::all();
        return view('admin.roles.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->help->checkPermission(Auth::user()->id, "roles-manage");
        if ($request->role_name == null)
            return redirect('dashboard/user/roles/create')->withInput()->withErrors(['کاربر گرامی ، وارد کردن عنوان اجباری می باشد.']);
        if (Role::where('role_name', $request->role_name)->first())
            return redirect('dashboard/user/roles/create')->withInput()->withErrors(['کاربر گرامی ،عنوان تکراری می باشد.']);
        $roles = Role::create(['role_name' => $request->role_name, 'updated_at' => strtotime(date('Y-m-d H:i:s')), 'created_at' => strtotime(date('Y-m-d H:i:s'))]);

        if (isset($request->permission_id))
            foreach ($request->permission_id as $key => $value) {
                Role_Permissions::create(['role_id' => $roles->id, 'permission_id' => $value]);
            }
        return redirect('/dashboard/user/roles/create')->with('success', 'کاربر گرامی ، اطلاعات با موفقیت ثبت شد.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->help->checkPermission(Auth::user()->id, "roles-manage");
        $data['editValue'] = Role::where('id', $id)->first();
        $data['role_permissions'] = Role_Permissions::where('role_id', $id)->get();
        $data['permissionsInfo'] = Permission::all();
        if (sizeof($data['role_permissions']) == sizeof($data['permissionsInfo']))
            $data['checkAll'] = true;
        else
            $data['checkAll'] = false;

        return view('admin.roles.create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->help->checkPermission(Auth::user()->id, "roles-manage");
        $data['editValue'] = Role::where('id', $id)->first();
        $data['role_permissions'] = Role_Permissions::where('role_id', $id)->get();
        $data['permissionsInfo'] = Permission::all();
        if (sizeof($data['role_permissions']) == sizeof($data['permissionsInfo']))
            $data['checkAll'] = true;
        else
            $data['checkAll'] = false;
        if (!$data['editValue'])
            return redirect('Web/V1/roles');
        if ($request->role_name == null)
            return view('admin.roles.create', $data)->withErrors(['کاربر گرامی ، وارد کردن عنوان اجباری می باشد.']);
        if (Role::where('role_name', $request->role_name)->where('id', '!=', $id)->first())
            return view('admin.roles.create', $data)->withErrors(['کاربر گرامی ،عنوان تکراری می باشد.']);
        Role::where('id', $id)->update(['role_name' => $request->role_name, 'updated_at' => strtotime(date('Y-m-d H:i:s'))]);

        Role_Permissions::where('role_id', $id)->delete();
        if (isset($request->permission_id))
            foreach ($request->permission_id as $key => $value) {
                Role_Permissions::create(['role_id' => $id, 'permission_id' => $value]);

            }
        return redirect('/dashboard/user/roles');
    }
}
