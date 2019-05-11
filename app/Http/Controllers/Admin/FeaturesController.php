<?php

namespace App\Http\Controllers\Admin;

use App\Features;
use App\GroupFeatures;
use App\Inside\Helpers;
use App\Inside\PrivilegedUsers;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FeaturesController extends Controller
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
        $this->help->checkPermission(Auth::user()->id, "features-manage");
        $data['featuresInfo'] = Features::paginate(10);
        return view('admin.features.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->help->checkPermission(Auth::user()->id, "features-manage");
        $data['groupFeaturesInfo'] = GroupFeatures::all();
        return view('admin.features.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->help->checkPermission(Auth::user()->id, "features-manage");
        if ($request->title == null)
            return redirect('features/create')->withInput()->withErrors(['کاربر گرامی ، وارد کردن عنوان اجباری می باشد.']);
        if ($features = Features::where('title', $request->title)->first())
            return redirect('features/create')->withInput()->withErrors(['کاربر گرامی ،عنوان تکراری می باشد.']);
        Features::create([
            'type_app_id' => Auth::user()->type_app_id,
            'group_features_id' => $request->input('group_features_id'),
            'title' => $request->title,
            'description' => $request->description,
        ]);
        return redirect('features/create')->with('success', 'کاربر گرامی ، اطلاعات با موفقیت ثبت شد.');
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
        $this->help->checkPermission(Auth::user()->id, "features-manage");
        $data['editValue'] = Features::where('id', $id)->first();
        $data['groupFeaturesInfo'] = GroupFeatures::all();
        if (!$data['editValue'])
            return redirect('features');
        return view('admin.features.create', $data);
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
        $this->help->checkPermission(Auth::user()->id, "features-manage");
        $data['editValue'] = Features::where('id', $id)->first();
        $data['groupFeaturesInfo'] = GroupFeatures::all();
        if (!$data['editValue'])
            return redirect('features');
        if ($request->title == null)
            return view('admin.features.create', $data)->withErrors(['کاربر گرامی ، وارد کردن عنوان اجباری می باشد.']);
        if (Features::where('title', $request->title)->where('id', '!=', $id)->first())
            return view('admin.features.create', $data)->withErrors(['کاربر گرامی ،عنوان تکراری می باشد.']);
        Features::where('id', $id)->update([
            'title' => $request->title,
            'group_features_id' => $request->group_features_id,
            'description' => $request->description,
        ]);
        return redirect('features');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $this->help->checkPermission(Auth::user()->id, "features-manage");
        Features::where('id', $id)->delete();
        return redirect('features');
    }
}
