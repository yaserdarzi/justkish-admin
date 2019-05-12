<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Features;
use App\Inside\Helpers;
use App\Products;
use App\ProductsFeaturesAnswers;
use App\ProductsGallery;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
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
        $user_id = Auth::user()->id;
        $this->help->checkPermission($user_id, "products-manage");
        $data['categoryInfo'] = Category::orderBy('sort')->get();
        $data['productsInfo'] = Products::with('category')->orderBy('sort')->paginate(10);
        return view('admin.products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = Auth::user()->id;
        $this->help->checkPermission($user_id, "products-manage");
        $role = $this->help->getRoles($user_id);
        if ($role != "admin")
            return redirect('products');
        $data['categoryInfo'] = Category::all();
        $data['featuresInfo'] = Features::where("group_features_id", $data['categoryInfo'][0]->group_features_id)->get();
        return view('admin.products.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $this->help->checkPermission($user_id, "products-manage");
        if ($request->title == null)
            return redirect('products/create')->withInput()->withErrors(['کاربر گرامی ، وارد کردن عنوان اجباری می باشد.']);
        if (!$request->star)
            $request->star = 0;
        if (!$request->sort)
            $request->sort = 0;
        $is_happy = false;
        if (isset($request->is_happy))
            $is_happy = true;
        $special_offer = false;
        if (isset($request->special_offer))
            $special_offer = true;
        $is_best_sales = false;
        if (isset($request->is_best_sales))
            $is_best_sales = true;
        $today_buy = false;
        if (isset($request->today_buy))
            $today_buy = true;
        $time_limitation = false;
        if (isset($request->time_limitation))
            $time_limitation = true;
        $images = "";
        if (isset($request->image)) {
            $images = md5(\File::get($request->file("image"))) . '.' . $request->file("image")->getClientOriginalExtension();
            \Storage::disk('upload')->makeDirectory('/products/');
            $exists = \Storage::disk('upload')->has('/products/' . $images);
            if ($exists == null)
                \Storage::disk('upload')->put('/products/' . $images, \File::get($request->image->getRealPath()));
        }
        $products = Products::create([
            'type_app_id' => Auth::user()->type_app_id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'image' => $images,
            'small_description' => $request->small_description,
            'description' => $request->description,
            'rule' => $request->rule,
            'recovery' => $request->recovery,
            'terms_of_use' => $request->terms_of_use,
            'sort' => $request->sort,
            'is_happy' => $is_happy,
            'is_best_sales' => $is_best_sales,
            'time_limitation' => $time_limitation,
            'special_offer' => $special_offer,
            'today_buy' => $today_buy,
            'star' => $request->star,
            'price_adult' => str_replace(',', '', $request->input('price_adult')),
            'price_child' => str_replace(',', '', $request->input('price_child')),
            'price_baby' => str_replace(',', '', $request->input('price_baby')),
            'cash_back' => str_replace(',', '', $request->input('cash_back')),
        ]);
        foreach ($request->files as $file)
            foreach ($file as $key => $value) {
                if (isset($value)) {
                    $image = md5(\File::get($value)) . '.' . $value->getClientOriginalExtension();
                    $mimeType = $value->getClientMimeType();
                    \Storage::disk('upload')->makeDirectory('/products/' . $products->id . '/');
                    $exists = \Storage::disk('upload')->has('/products/' . $products->id . '/' . $image);
                    if ($exists == null)
                        \Storage::disk('upload')->put('/products/' . $products->id . '/' . $image, \File::get($value->getRealPath()));
                    ProductsGallery::create([
                        'type_app_id' => Auth::user()->type_app_id,
                        'products_id' => $products->id,
                        'path' => $image,
                        'status' => 1,
                        'mime_type' => $mimeType,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                }
            }
        $featuresInfo = Features::all();
        foreach ($featuresInfo as $value) {
            $input = $request->input('features_' . $value->id);
            if ($input != null)
                foreach ($input as $val)
                    ProductsFeaturesAnswers::create([
                        'type_app_id' => Auth::user()->type_app_id,
                        'products_id' => $products->id,
                        'features_id' => $value->id,
                        'features_questions_answers_id' => $val,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
        }
        return redirect('products/create')->with('success', 'کاربر گرامی ، اطلاعات با موفقیت ثبت شد.');
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
        $user_id = Auth::user()->id;
        $this->help->checkPermission($user_id, "products-manage");
        $data['editValue'] = products::where('id', $id)->first();
        if (!$data['editValue'])
            return redirect('products');
        $data['categoryInfo'] = Category::all();
        $data['galleryInfo'] = ProductsGallery::where('products_id', $id)->get();
        $data['featuresInfo'] = Features::where("group_features_id", $data['editValue']->group_features_id)->get();
        return view('admin.products.create', $data);
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
        $user_id = Auth::user()->id;
        $this->help->checkPermission($user_id, "products-manage");
        $data['editValue'] = products::where('id', $id)->first();
        if (!$data['editValue'])
            return redirect('products');
        $data['categoryInfo'] = Category::all();
        $data['galleryInfo'] = ProductsGallery::where('products_id', $id)->get();
        $data['featuresInfo'] = Features::where("group_features_id", $data['editValue']->group_features_id)->get();
        if ($request->title == null)
            return view('products/' . $id . '/edit', $data)->withInput()->withErrors(['کاربر گرامی ، وارد کردن عنوان اجباری می باشد.']);
        $is_happy = false;
        if (isset($request->is_happy))
            $is_happy = true;
        $today_buy = false;
        if (isset($request->today_buy))
            $today_buy = true;
        $time_limitation = false;
        if (isset($request->time_limitation))
            $time_limitation = true;
        $special_offer = false;
        if (isset($request->special_offer))
            $special_offer = true;
        $is_best_sales = false;
        if (isset($request->is_best_sales))
            $is_best_sales = true;
        $images = $data['editValue']->image;
        if (isset($request->image)) {
            $existsDel = \Storage::disk('upload')->has('/products/' . $data['editValue']->images);
            if ($existsDel != null)
                @\Storage::disk('upload')->delete('/products/' . $data['editValue']->images);
            $images = time() . md5(pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $request->image->getClientOriginalExtension();
            \Storage::disk('upload')->makeDirectory('/products/');
            $exists = \Storage::disk('upload')->has('/products/' . $images);
            if ($exists == null)
                \Storage::disk('upload')->put('/products/' . $images, \File::get($request->image->getRealPath()));
        }
        Products::where('id', $id)->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'image' => $images,
            'small_description' => $request->small_description,
            'description' => $request->description,
            'rule' => $request->rule,
            'recovery' => $request->recovery,
            'terms_of_use' => $request->terms_of_use,
            'sort' => $request->sort,
            'is_happy' => $is_happy,
            'is_best_sales' => $is_best_sales,
            'time_limitation' => $time_limitation,
            'special_offer' => $special_offer,
            'today_buy' => $today_buy,
            'star' => $request->star,
            'price_adult' => str_replace(',', '', $request->input('price_adult')),
            'price_child' => str_replace(',', '', $request->input('price_child')),
            'price_baby' => str_replace(',', '', $request->input('price_baby')),
            'cash_back' => str_replace(',', '', $request->input('cash_back')),
        ]);
        foreach ($request->files as $file)
            foreach ($file as $key => $value) {
                if (isset($value)) {
                    $image = md5(\File::get($value)) . '.' . $value->getClientOriginalExtension();
                    $mimeType = $value->getClientMimeType();
                    \Storage::disk('upload')->makeDirectory('/products/' . $data['editValue']->id . '/');
                    $exists = \Storage::disk('upload')->has('/products/' . $data['editValue']->id . '/' . $image);
                    if ($exists == null)
                        \Storage::disk('upload')->put('/products/' . $data['editValue']->id . '/' . $image, \File::get($value->getRealPath()));
                    ProductsGallery::create([
                        'type_app_id' => Auth::user()->type_app_id,
                        'products_id' => $data['editValue']->id,
                        'path' => $image,
                        'status' => 1,
                        'mime_type' => $mimeType,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                }
            }
        ProductsFeaturesAnswers::where('products_id', $data['editValue']->id)->delete();
        foreach ($data['featuresInfo'] as $value) {
            $input = $request->input('features_' . $value->id);
            if ($input != null)
                foreach ($input as $val)
                    ProductsFeaturesAnswers::create([
                        'type_app_id' => Auth::user()->type_app_id,
                        'products_id' => $data['editValue']->id,
                        'features_id' => $value->id,
                        'features_questions_answers_id' => $val,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
        }
        return redirect('products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $user_id = Auth::user()->id;
        $this->help->checkPermission($user_id, "products-manage");
        Products::where('id', $id)->delete();
        return redirect('products');
    }

    ////////////////////////function/////////////////////////////////////////////

    public function deleteGallery(Request $request)
    {
        $user_id = Auth::user()->id;
        $this->help->checkPermission($user_id, "products-manage");
        ProductsGallery::where('id', $request->id)->where('products_id', $request->products_id)->delete();
        return 'true';
    }
}
