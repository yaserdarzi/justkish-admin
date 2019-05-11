<?php

namespace App\Http\Controllers\Admin;

use App\Features;
use App\FeaturesQuestionsAnswers;
use App\Inside\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FeaturesQuestionsAnswersController extends Controller
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
    public function index($features_id)
    {
        $this->help->checkPermission(Auth::user()->id, "features-manage");
        $data['featuresInfo'] = Features::where('id', $features_id)->first();
        if (!$data['featuresInfo'])
            return redirect('features');
        $data['featuresQuestionsAnswersInfo'] = FeaturesQuestionsAnswers::where('features_id', $features_id)->get();
        $data['features_id'] = $features_id;
        return view('admin.features.featuresQuestionsAnswer.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($features_id, Request $request)
    {
        $this->help->checkPermission(Auth::user()->id, "features-manage");
        $data['featuresInfo'] = Features::where('id', $features_id)->first();
        if (!$data['featuresInfo'])
            return redirect('features');
        $data['features_id'] = $features_id;
        return view('admin.features.featuresQuestionsAnswer.create', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store($features_id, Request $request)
    {
        $this->help->checkPermission(Auth::user()->id, "features-manage");
        $data['featuresInfo'] = Features::where('id', $features_id)->first();
        if (!$data['featuresInfo'])
            return redirect('features');
        $data['features_id'] = $features_id;
        $images = '';
        if (isset($request->image)) {
            $images = $features_id . time() . md5(pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $request->image->getClientOriginalExtension();
            \Storage::disk('upload')->makeDirectory('/features/' . $features_id . '/answers');
            $exists = \Storage::disk('upload')->has('/features/' . $features_id . '/answers/' . $images);
            if ($exists == null)
                \Storage::disk('upload')->put('/features/' . $features_id . '/answers/' . $images, \File::get($request->image->getRealPath()));
        }
        FeaturesQuestionsAnswers::create([
            'type_app_id' => Auth::user()->type_app_id,
            'features_id' => $features_id,
            'title' => $request->title,
            'image' => $images,
        ]);
        return redirect('features/' . $features_id . '/answers/create')->with('success', 'کاربر گرامی ، اطلاعات با موفقیت ثبت شد.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($features_id, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($features_id, $id, Request $request)
    {
        $this->help->checkPermission(Auth::user()->id, "features-manage");
        $data['featuresInfo'] = Features::where('id', $features_id)->first();
        if (!$data['featuresInfo'])
            return redirect('features');
        $data['features_id'] = $features_id;
        $data['editValue'] = FeaturesQuestionsAnswers::where('id', $id)->first();
        if (!$data['editValue'])
            return redirect('editValue');
        return view('admin.features.featuresQuestionsAnswer.create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update($features_id, Request $request, $id)
    {
        $this->help->checkPermission(Auth::user()->id, "features-manage");
        $data['featuresInfo'] = Features::where('id', $features_id)->first();
        if (!$data['featuresInfo'])
            return redirect('features');
        $data['features_id'] = $features_id;
        $data['editValue'] = FeaturesQuestionsAnswers::where('id', $id)->first();
        if (!$data['editValue'])
            return redirect('features/' . $features_id . '/answers');
        $images = $data['editValue']->image;
        if (isset($request->image)) {
            $existsDel = \Storage::disk('upload')->has('/features/' . $features_id . '/answers/' . $data['editValue']->images);
            if ($existsDel != null)
                @\Storage::disk('upload')->delete('/features/' . $features_id . '/answers/' . $data['editValue']->images);
            $images = $features_id . time() . md5(pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $request->image->getClientOriginalExtension();
            \Storage::disk('upload')->makeDirectory('/features/' . $features_id . '/answers/');
            $exists = \Storage::disk('upload')->has('/features/' . $features_id . '/answers/' . $images);
            if ($exists == null)
                \Storage::disk('upload')->put('/features/' . $features_id . '/answers/' . $images, \File::get($request->image->getRealPath()));
        }
        FeaturesQuestionsAnswers::where('id', $id)->update([
            'title' => $request->title,
            'image' => $images,
        ]);
        return redirect('features/' . $features_id . '/answers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($features_id, $id)
    {
        $this->help->checkPermission(Auth::user()->id, "features-manage");
        $data['featuresInfo'] = Features::where('id', $features_id)->first();
        if (!$data['featuresInfo'])
            return redirect('features');
        $data['features_id'] = $features_id;
        FeaturesQuestionsAnswers::where('id', $id)->delete();
        return redirect('features/' . $features_id . '/answers');
    }
}
