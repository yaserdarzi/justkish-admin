<?php

namespace App\Http\Controllers\Admin;

use App\Inside\Helpers;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
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
        $this->help->checkPermission(Auth::user()->id, "admin-manage");
        $data['adminInfo'] = User::paginate(10);
        foreach ($data['adminInfo'] as $value)
            $value->role_name = $this->help->getRoles($value->id);
        return view('admin.admin.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->help->checkPermission(Auth::user()->id, "admin-manage");
        $data['roleAdminInfo'] = Role::all();
        return view('admin.admin.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admin_id = Auth::user()->id;
        $this->help->checkPermission($admin_id, "admin-manage");
        if ($request->input('name') == null)
            return redirect('admin/create')->withInput()->withErrors(['کاربر گرامی ، وارد کردن نام اجباری می باشد.']);
        if ($request->input('email') == null)
            return redirect('admin/create')->withInput()->withErrors(['کاربر گرامی ، وارد کردن پست الکترونیک اجباری می باشد.']);
        if ($request->input('password') == null)
            return redirect('admin/create')->withInput()->withErrors(['کاربر گرامی ، وارد کردن گذرواژه اجباری می باشد.']);
        if ($request->input('rePassword') == null)
            return redirect('admin/create')->withInput()->withErrors(['کاربر گرامی ، وارد کردن تکرار گذرواژه اجباری می باشد.']);
        if (strlen($request->input('password')) < 6)
            return redirect('admin/create')->withInput()->withErrors(['کاربر گرامی ، گذرواژه کوچک تر از ۶ رقم می باشد.']);
        if ($request->input('rePassword') != $request->input('password'))
            return redirect('admin/create')->withInput()->withErrors(['کاربر گرامی ، گذرواژه هم خوانی ندارد.']);
        if (User::where("email", $request->input('email'))->exists())
            return redirect('admin/create')->withInput()->withErrors(['کاربر گرامی ، نام کاربری تکراری می باشد.']);
        $admin = User::create([
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'name' => $request->input('name'),
            'activated' => true,
        ]);
        DB::table('role_admin')->insert(["admin_id" => $admin->id, "role_id" => $request->input('role_id')]);
        return redirect('admin/create')->with('success', 'کاربر گرامی ، اطلاعات با موفقیت ثبت شد.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->help->checkPermission(Auth::user()->id, "admin-manage");
        $data['roleAdminInfo'] = Role::all();
        $data['editValue'] = User::where('id', $id)->first();
        $data['editValue']->role_id = DB::table('role_admin')->where('admin_id', $id)->first()->role_id;
        if (!$data['editValue'])
            return redirect('admin');
        return view('admin.admin.create', $data);
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
        $this->help->checkPermission(Auth::user()->id, "admin-manage");
        $data['roleAdminInfo'] = Role::all();
        $data['editValue'] = User::where('id', $id)->first();
        $data['editValue']->role_id = DB::table('role_admin')->where('admin_id', $id)->first()->role_id;
        if (!$data['editValue'])
            return redirect('admin');
        if (User::where('email', $request->input('email'))->where('id', '!=', $id)->first())
            return redirect('admin/create')->withInput()->withErrors(['کاربر گرامی ،پست الکترونیک تکراری می باشد.']);
        User::where('id', $id)->update([
            'email' => $request->input('email'),
            'name' => $request->input('name')
        ]);
        DB::table('role_admin')->where('admin_id', $id)->update(["role_id" => $request->input('role_id')]);
        return redirect('admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $this->help->checkPermission(Auth::user()->id, "admin-manage");
        User::where('id', $id)->delete();
        return redirect('admin');
    }
}
