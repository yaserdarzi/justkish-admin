<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Inside\Constants;
use App\Inside\Helpers;
use App\Inside\PrivilegedUsers;
use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;

class PermissionsController extends Controller
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
        $data['permissionsInfo'] = Permission::paginate(10);
        return view('admin.roles.permissions.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->help->checkPermission(Auth::user()->id, "roles-manage");
        return view('admin.roles.permissions.create');
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
        if ($request->route_name == null)
            return redirect('user/categories/create')->withInput()->withErrors(['کاربر گرامی ، وارد کردن عنوان اجباری می باشد.']);
        if (Permission::where('route_name', $request->route_name)->first())
            return redirect('user/permissions/create')->withInput()->withErrors(['کاربر گرامی ،عنوان تکراری می باشد.']);

        Permission::create(['route_name' => $request->route_name, 'description' => $request->description, 'updated_at' => strtotime(date('Y-m-d H:i:s')), 'created_at' => strtotime(date('Y-m-d H:i:s'))]);
        return redirect('user/permissions/create')->with('success', 'کاربر گرامی ، اطلاعات با موفقیت ثبت شد.');
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
        $data['editValue'] = Permission::where('id', $id)->first();
        return view('admin.roles.permissions.create', $data);
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
        $data['editValue'] = Permission::where('id', $id)->first();
        if (!$data['editValue'])
            return redirect('user/permissions');
        if ($request->route_name == null)
            return view('admin.roles.permissions.create', $data)->withErrors(['کاربر گرامی ، وارد کردن عنوان اجباری می باشد.']);
        if (Permission::where('route_name', $request->route_name)->where('id', '!=', $id)->first())
            return view('admin.roles.permissions.create', $data)->withErrors(['کاربر گرامی ،عنوان تکراری می باشد.']);
        Permission::where('id', $id)->update(['route_name' => $request->route_name, 'description' => $request->description, 'updated_at' => strtotime(date('Y-m-d H:i:s'))]);

        return redirect('user/permissions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
