<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Features;
use App\FeaturesQuestionsAnswers;
use App\GroupFeatures;
use App\Inside\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GroupFeaturesController extends Controller
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
        $this->help->checkPermission(Auth::user()->id, "group-features-manage");
        $data['groupFeaturesInfo'] = GroupFeatures::paginate(10);
        return view('admin.group_features.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->help->checkPermission(Auth::user()->id, "group-features-manage");
        return view('admin.group_features.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->help->checkPermission(Auth::user()->id, "group-features-manage");
        if ($request->title == null)
            return redirect('group_features/create')->withInput()->withErrors(['کاربر گرامی ، وارد کردن عنوان اجباری می باشد.']);
        GroupFeatures::create([
            'type_app_id' => Auth::user()->type_app_id,
            'title' => $request->title,
            'description' => $request->description,
        ]);
        return redirect('group_features/create')->with('success', 'کاربر گرامی ، اطلاعات با موفقیت ثبت شد.');
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
        $this->help->checkPermission(Auth::user()->id, "group-features-manage");
        $data['editValue'] = GroupFeatures::where('id', $id)->first();
        if (!$data['editValue'])
            return redirect('group_features');
        return view('admin.group_features.create', $data);
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
        $this->help->checkPermission(Auth::user()->id, "group-features-manage");
        $data['editValue'] = GroupFeatures::where('id', $id)->first();
        if (!$data['editValue'])
            return redirect('group_features');
        if ($request->title == null)
            return view('admin.group_features.create', $data)->withErrors(['کاربر گرامی ، وارد کردن عنوان اجباری می باشد.']);
        GroupFeatures::where('id', $id)->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        return redirect('group_features');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $this->help->checkPermission(Auth::user()->id, "group-features-manage");
        GroupFeatures::where('id', $id)->delete();
        return redirect('group_features');
    }

    public function getFeatures(Request $request)
    {
        $category = Category::where('id', $request->input('category_id'))->first();
        $featuresInfo = Features::where("group_features_id", $category->group_features_id)->get();
        $result = "";
        foreach ($featuresInfo as $value) {
            $result .= '<div class="form-title">';
            $result .= '<div class="field">';
            $result .= '<label for="features_' . $value->id . '"><span class="icon-map-pin"></span>' . $value->title . '</label>';
            $result .= '<select class="js-example-tags tagSearch" id="features_' . $value->id . '" name="features_' . $value->id . '[]" multiple >';
            $featuresQuestionsAnswers = FeaturesQuestionsAnswers::where('features_id', $value->id)->get();
            foreach ($featuresQuestionsAnswers as $valAnswers)
                $result .= '<option value="' . $valAnswers->id . '">' . $valAnswers->title . '</option>';
            $result .= '</select>';
            $result .= '</div>';
            $result .= '</div>';
            $result .= '<script>$(".tagSearch").select2({tags: true})</script>';
        }
        return $result;
    }
}
