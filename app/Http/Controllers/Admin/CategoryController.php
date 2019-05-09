<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Inside\Constants;
use App\Inside\Helpers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
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
    public function index(Request $request)
    {
        $this->help->checkPermission(Auth::user()->id, "category-manage");
        $data['categoryInfo'] = Category::orderBy('sort')->get();
        return view('admin.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->help->checkPermission(Auth::user()->id, "category-manage");
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->help->checkPermission(Auth::user()->id, "category-manage");
        if ($request->input('title') == null)
            return redirect('category/create')->withInput()->withErrors(['کاربر گرامی ، وارد کردن عنوان اجباری می باشد.']);
        if ($request->input('sort') == null)
            return redirect('category/create')->withInput()->withErrors(['کاربر گرامی ، وارد کردن ترتیب نمایش اجباری می باشد.']);
        if (!$request->file('icon'))
            return redirect('category/create')->withInput()->withErrors(['کاربر گرامی ، وارد کردن ایکون اجباری می باشد.']);
        if (!in_array($request->file('icon')->getClientMimeType(), Constants::PHOTO_TYPE))
            return redirect('category/create')->withInput()->withErrors(['کاربر گرامی ، وارد کردن ایکون اجباری می باشد.']);
        \Storage::disk('upload')->makeDirectory('/category/');
        $icon = md5(\File::get($request->file("icon"))) . '.' . $request->file("icon")->getClientOriginalExtension();
        $exists = \Storage::disk('upload')->has('/category/' . $icon);
        if ($exists == null)
            \Storage::disk('upload')->put('/category/' . $icon, \File::get($request->file('icon')->getRealPath()));
        Category::create([
            'type_app_id' => Auth::user()->type_app_id,
            'title' => $request->input('title'),
            'icon' => $icon,
            'desc' => $request->input('desc'),
            'sort' => $request->input('sort'),
            'link' => $request->input('link')
        ]);
        return redirect('category/create')->with('success', 'کاربر گرامی ، اطلاعات با موفقیت ثبت شد.');
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
        $this->help->checkPermission(Auth::user()->id, "category-manage");
        $data['editValue'] = Category::where('id', $id)->first();
        if (!$data['editValue'])
            return redirect('category');
        return view('admin.category.create', $data);
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
        $this->help->checkPermission(Auth::user()->id, "category-manage");
        $data['editValue'] = Category::where('id', $id)->first();
        if (!$data['editValue'])
            return redirect('category');
        if ($request->input('title') == null)
            return view('category/create', $data)->withInput()->withErrors(['کاربر گرامی ، وارد کردن عنوان اجباری می باشد.']);
        if ($request->input('sort') == null)
            return view('category/create', $data)->withInput()->withErrors(['کاربر گرامی ، وارد کردن ترتیب نمایش اجباری می باشد.']);
        $icon = $data['editValue']->icon;
        if ($request->file('icon')) {
            \Storage::disk('upload')->makeDirectory('/category/');
            $icon = md5(\File::get($request->file("icon"))) . '.' . $request->file("icon")->getClientOriginalExtension();
            $exists = \Storage::disk('upload')->has('/category/' . $icon);
            if ($exists == null)
                \Storage::disk('upload')->put('/category/' . $icon, \File::get($request->file('icon')->getRealPath()));
        }
        Category::where('id', $id)->update([
            'title' => $request->input('title'),
            'icon' => $icon,
            'desc' => $request->input('desc'),
            'sort' => $request->input('sort'),
            'link' => $request->input('link')
        ]);
        return redirect('category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $this->help->checkPermission(Auth::user()->id, "category-manage");
        Category::where('id', $id)->delete();
        return redirect('category');
    }
}
