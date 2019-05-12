@extends('layouts.pages')
@section('title')
    @if(isset($editValue))
        {{'ویرایش محصولات'}}
    @else
        {{'افزودن محصولات'}}
    @endif
@endsection
@section('content')
    <!-- Page Header -->
    <form method="POST" action="{{url('products')}}@if(isset($editValue))/{{$editValue->id}}@endif"
          files="true" enctype="multipart/form-data">
        {!! csrf_field() !!}
        @if(isset($editValue))
            <input type="hidden" name="_method" value="PATCH">
        @endif
        <header class="page-header">
            <div class="content">
                <div class="title">
                    @if(isset($editValue))
                        <h1> ویرایش محصولات </h1>
                    @else
                        <h1> افزودن محصولات </h1>
                    @endif
                </div>
                <div class="functions">
                    @if(isset($editValue))
                        <button class="purple"> ویرایش</button>
                    @else
                        <button class="purple"> انتشار</button>
                    @endif
                </div>
            </div>
        </header>
        <div class="main-content">
            <div class="row">
                @if(Session::get('success')!=null)
                    <div class="alert alt green">
                        <p>{{Session::get('success')}}</p>
                        <a href="#" class="icon-close alert-close "></a>
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alt red">
                        <p>{{$errors->first()}}</p>
                        <a href="#" class="icon-close alert-close "></a>
                    </div>
                @endif
                <div class="col-sm-8">
                    <!-- Form General -->
                    <section class="panel form-general">
                        <article>
                            <ul class="tabs-contents">
                                <li id="tab-lang-fa">

                                    <div class="form-title field">
                                        <label for="is_happy"
                                               style="height: 12px !important;display: inline-block"><span
                                                    style="margin-right: 30px;color:green">پیشنهادهای خوشحال طور</span>
                                            <input
                                                    style="width: 20px !important;display: inherit;position: relative;top: 14px; right: -165px;"
                                                    @if(isset($editValue))
                                                    @if($editValue->is_happy==true)
                                                    checked
                                                    @endif
                                                    @endif
                                                    type="checkbox" id="is_happy" name="is_happy">
                                        </label>

                                        <label for="is_best_sales"
                                               style="height: 12px !important;display: inline-block !important;"><span
                                                    style="margin-right: 10px;color:green">پرفروش ها</span>
                                            <input
                                                    style="width: 20px !important;display: inherit;position: relative;top: 14px; right: -85px;"
                                                    @if(isset($editValue))
                                                    @if($editValue->is_best_sales==true)
                                                    checked
                                                    @endif
                                                    @endif
                                                    type="checkbox" id="is_best_sales" name="is_best_sales">
                                        </label>

                                        <label for="today_buy"
                                               style="height: 12px !important;display: inline-block !important;"><span
                                                    style="margin-right: 10px;color:green">قابلیت خرید در همان روز</span>
                                            <input
                                                    style="width: 20px !important;display: inherit;position: relative;top: 14px; right: -155px;"
                                                    @if(isset($editValue))
                                                    @if($editValue->today_buy==true)
                                                    checked
                                                    @endif
                                                    @endif
                                                    type="checkbox" id="today_buy" name="today_buy">
                                        </label>

                                        <label for="time_limitation"
                                               style="height: 12px !important;display: inline-block !important;"><span
                                                    style="margin-right: 10px;color:green">داری محدودیت زمانی</span>
                                            <input
                                                    style="width: 20px !important;display: inherit;position: relative;top: 14px; right: -140px;"
                                                    @if(isset($editValue))
                                                    @if($editValue->time_limitation==true)
                                                    checked
                                                    @endif
                                                    @endif
                                                    type="checkbox" id="time_limitation" name="time_limitation">
                                        </label>

                                        <label for="special_offer"
                                               style="height: 12px !important;display: inline-block !important;"><span
                                                    style="margin-right: 25px;color:green">پیشنهاد ویژه</span>
                                            <input
                                                    style="width: 20px !important;display: inherit;position: relative;top: 14px; right: -95px;"
                                                    @if(isset($editValue))
                                                    @if($editValue->special_offer==true)
                                                    checked
                                                    @endif
                                                    @endif
                                                    type="checkbox" id="special_offer" name="special_offer">
                                        </label>

                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="category_id"><span class="icon-map-pin"></span>گروه</label>
                                            <div class="select">
                                                <select id="category_id" name="category_id">
                                                    @if(isset($categoryInfo))
                                                        @foreach($categoryInfo as $key=>$value)
                                                            <option
                                                                    @if(isset($editValue)) @if($editValue->category_id==$value->id){{'selected'}}@endif @else @if(old('category_id')==$value->title){{'selected'}}@endif @endif  value="{{$value->id}}">{{$value->title}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="title"><span class="icon-map-pin"></span> عنوان</label>
                                            <input type="text" id="title" name="title" placeholder="عنوان"
                                                   value="@if(isset($editValue)){{$editValue->title}}@else{{old('title')}}@endif"
                                                   class="title lg">
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="sort"><span class="icon-map-pin"></span> ترتیب نمایش</label>
                                            <input type="text" id="sort" name="sort" placeholder="ترتیب نمایش"
                                                   onkeypress="return onlynumber(event);"
                                                   value="{{old('sort')}}@if(isset($editValue)){{$editValue->sort}}@endif"
                                                   class="title lg">
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="star"><span class="icon-map-pin"></span> تعداد ستارها </label>
                                            <input type="text" id="star" name="star" placeholder="تعداد ستارها"
                                                   onkeypress="return onlynumber(event);" max="5" min="0" maxlength="1"
                                                   value="{{old('star')}}@if(isset($editValue)){{$editValue->star}}@endif"
                                                   class="title lg">
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="price_adult"><span class="icon-map-pin"></span>مبلغ بزرگسال (12
                                                سال به بالا)</label>
                                            <input type="text" id="price_adult" name="price_adult"
                                                   placeholder="مبلغ بزرگسال (12 سال به بالا)"
                                                   onkeypress="return onlynumber(event);"
                                                   onkeyup="javascript:this.value=Number_Three_digit(this.value);"
                                                   value="@if(isset($editValue)){{$editValue->price_adult}}@else{{old('price_adult')}}@endif"
                                                   class="title lg">
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="price_child"><span class="icon-map-pin"></span>مبلغ کودک (2 سال
                                                تا 12 سال)</label>
                                            <input type="text" id="price_child" name="price_child"
                                                   placeholder="مبلغ کودک (2 سال تا 12 سال)"
                                                   onkeypress="return onlynumber(event);"
                                                   onkeyup="javascript:this.value=Number_Three_digit(this.value);"
                                                   value="@if(isset($editValue)){{$editValue->price_child}}@else{{old('price_child')}}@endif"
                                                   class="title lg">
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="price_baby"><span class="icon-map-pin"></span>مبلغ نوزاد (10 روز
                                                تا 2 سال)</label>
                                            <input type="text" id="price_baby" name="price_baby"
                                                   placeholder="مبلغ نوزاد (10 روز تا 2 سال)"
                                                   onkeypress="return onlynumber(event);"
                                                   onkeyup="javascript:this.value=Number_Three_digit(this.value);"
                                                   value="@if(isset($editValue)){{$editValue->price_baby}}@else{{old('price_baby')}}@endif"
                                                   class="title lg">
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="cash_back"><span class="icon-map-pin"></span>مبلغ کش بک</label>
                                            <input type="text" id="cash_back" name="cash_back" placeholder="مبلغ کش بک"
                                                   onkeypress="return onlynumber(event);"
                                                   onkeyup="javascript:this.value=Number_Three_digit(this.value);"
                                                   value="@if(isset($editValue)){{$editValue->cash_back}}@else{{old('cash_back')}}@endif"
                                                   class="title lg">
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="small_description"><span class="icon-map-pin"></span>
                                                توضیحات</label>
                                            <textarea id="small_description" name="small_description"
                                                      placeholder="توضیحات کوتاه"
                                                      rows="3">{{old('small_description')}}@if(isset($editValue)){{$editValue->small_description}}@endif</textarea>
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="description"><span class="icon-map-pin"></span> توضیحات</label>
                                            <textarea id="description" name="description" rows="5"
                                                      placeholder="توضیحات">{{old('description')}}@if(isset($editValue)){{$editValue->description}}@endif</textarea>
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="rule"><span class="icon-map-pin"></span> قوانین و مقررات</label>
                                            <textarea id="rule" name="rule" rows="5"
                                                      placeholder="قوانین و مقررات">{{old('rule')}}@if(isset($editValue)){{$editValue->rule}}@endif</textarea>
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="recovery"><span class="icon-map-pin"></span>شرایط جریمه استرداد</label>
                                            <textarea id="recovery" name="recovery" rows="5"
                                                      placeholder="شرایط جریمه استرداد">{{old('recovery')}}@if(isset($editValue)){{$editValue->recovery}}@endif</textarea>
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="terms_of_use"><span class="icon-map-pin"></span>شرایط
                                                استفاده</label>
                                            <textarea id="terms_of_use" name="terms_of_use" rows="5"
                                                      placeholder="شرایط استفاده">{{old('terms_of_use')}}@if(isset($editValue)){{$editValue->terms_of_use}}@endif</textarea>
                                        </div>
                                    </div>
                                    <div id="featuresInfo">
                                        @foreach($featuresInfo as $value)
                                            <div class="form-title">
                                                <div class="field">
                                                    <label for="features_{{$value->id}}"><span
                                                                class="icon-map-pin"></span>{{$value->title}}</label>
                                                    <select class="js-example-basic-multiple tagSearch"
                                                            id="features_{{$value->id}}"
                                                            name="features_{{$value->id}}[]" multiple>
                                                        <?php $featuresQuestionsAnswers = App\FeaturesQuestionsAnswers::where(['features_id' => $value->id])->get();?>
                                                        @foreach($featuresQuestionsAnswers as $valAnswers)
                                                            <option
                                                                    @if(isset($editValue))
                                                                    <?php $featuresAnswersInfo = App\FeaturesAnswers::where(['features_questions_answers_id' => $valAnswers->id])->first();?>
                                                                    @if($featuresAnswersInfo)
                                                                    {{"selected"}}
                                                                    @endif
                                                                    @endif
                                                                    value="{{$valAnswers->id}}">{{$valAnswers->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </li>
                            </ul>
                        </article>
                    </section>
                    <!-- Image Upload -->
                    <section class="panel">
                        <header>
                            <div class="title"><span class="icon-image"></span> آپلود گالری</div>
                            <div class="functions">
                                <a class="panel-toggle" href="#"></a>
                            </div>
                        </header>
                        <article>
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="file" name="files">
                            </form>
                            @if(isset($galleryInfo))
                                <div class="fileuploader fileuploader-theme-thumbnails">
                                    <div class="fileuploader-items">
                                        <ul class="fileuploader-items-list">
                                            @foreach($galleryInfo as $key=>$value)
                                                <li id="panel-image-{{$value->id}}"
                                                    class="fileuploader-item media-item file-type-image file-ext-jpg">
                                                    <div class="fileuploader-item-inner">
                                                        <div class="thumbnail-holder">
                                                            <div class="fileuploader-item-image"><img
                                                                        @if($value->status==2)
                                                                        src="{{$value->path}}"
                                                                        @else
                                                                        src="{{config('app.cdn_image_url').'/files/products/'.$editValue->id.'/'.$value->path}}"
                                                                        @endif
                                                                        draggable="false"></div>
                                                        </div>
                                                        <div class="actions-holder"><a id="{{$value->id}}"
                                                                                       onclick="deleteGallery(this.id);"
                                                                                       class="fileuploader-action fileuploader-action-remove"
                                                                                       title="Remove"><i
                                                                        class="remove"></i></a></div>
                                                        <div class="progress-holder"></div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </article>
                    </section>
                </div>
                <div class="col-sm-4">
                    <!-- Image Upload -->
                    <section class="panel">
                        <header>
                            <div class="title"><span class="icon-image"></span> آپلود تصویر</div>
                            <div class="functions">
                                <a class="panel-toggle" href="#"></a>
                            </div>
                        </header>
                        <article>
                            <div class="select-file image"
                                 @if(isset($editValue)) style="background-image: url('{{config('app.cdn_image_url').'/files/products/'.$editValue->image}}');"@endif>
                                <div class="field"><label for="image-upload">
                                        <div class="icon-upload"></div>
                                        <span>انتخاب فایل</span> </label> <input type="file" name="image"
                                                                                 id="image-upload">
                                </div>
                            </div>
                        </article>
                    </section>
                </div>
            </div>
        </div>
        {{--</form>--}}
        @endsection
        @section('css')
            <link href="{{asset('uploader/jquery.fileuploader.css')}}" media="all" rel="stylesheet">
            <link href="{{asset('uploader/thumbnails/css/jquery.fileuploader-theme-thumbnails.css')}}" media="all"
                  rel="stylesheet">
        @endsection
        @section('script')

            <script src="{{asset('js/dist/js/select2.js')}}"></script>
            <script src="{{asset('js/dist/js/select2.full.js')}}"></script>
            <script src="{{asset('js/tagSearchList.js')}}"></script>
            <script>
                $('#category_id').on('change', function () {
                    var Data = {
                        category_id: this.value
                    };
                    $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{url('/group_features/getFeatures')}}',
                        data: Data,
                        success: function (response) {
                            console.log(response);
                            if (response) {
                                $('#featuresInfo').html(response);
                            }
                        }
                    });
                });
            </script>
            <script src="{{asset('uploader/jquery.fileuploader.min.js')}}" type="text/javascript"></script>
            <script src="{{asset('uploader/thumbnails/js/custom.js')}}" type="text/javascript"></script>
            @if(isset($editValue))
                <script>
                    function deleteGallery(id) {
                        var r = confirm("کاربر گرامی ، آبا می خواهید تصویر مورد نظر را حذف نماید؟");
                        if (r == true) {
                            var Data = {
                                id: id,
                                products_id: '{{$editValue->id}}'
                            };
                            $.ajax({
                                type: 'POST',
                                dataType: 'json',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: '{{url('/products/delete-gallery')}}',
                                data: Data,
                                success: function (response) {
                                    if (response) {
                                        $('#panel-image-' + id).hide();
                                        alert('کاربر گرامی ، عملیات با موفقیت انجام شد.');
                                    }
                                }
                            });
                        }
                    }
                </script>
    @endif
@endsection
