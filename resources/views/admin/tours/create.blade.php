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
    <form method="POST" action="{{url('tours')}}@if(isset($editValue))/{{$editValue->id}}@endif"
          files="true" enctype="multipart/form-data">
        {!! csrf_field() !!}
        @if(isset($editValue))
            <input type="hidden" name="_method" value="PATCH">
        @endif
        <header class="page-header">
            <div class="content">
                <div class="title">
                    @if(isset($editValue))
                        <h1> ویرایش تور و پکیج </h1>
                    @else
                        <h1> افزودن تور و پکیج </h1>
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
                                        <label for="today_buy"
                                               style="height: 12px !important;display: inline-block !important;"><span
                                                    style="margin-right: 10px;color:green">قابلیت خرید در همان روز</span>
                                            <input style="width: 20px !important;display: inherit;position: relative;top: 14px; right: -155px;"
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
                                            <input style="width: 20px !important;display: inherit;position: relative;top: 14px; right: -140px;"
                                                   @if(isset($editValue))
                                                   @if($editValue->time_limitation==true)
                                                   checked
                                                   @endif
                                                   @endif
                                                   type="checkbox" id="time_limitation" name="time_limitation">
                                        </label>

                                    </div>


                                    <div class="form-title">
                                        <div class="field">
                                            <label for="title"><span class="icon-map-pin"></span> عنوان</label>
                                            <input type="text" id="title" name="title" placeholder="عنوان"
                                                   value="@if(isset($editValue)){{$editValue->title}}@else{{old('title')}}@endif"
                                                   class="title lg">
                                        </div>
                                    </div>
                                    <div id="featuresInfo">
                                        <div class="form-title">
                                            <div class="field">
                                                <label for="product_id"><span
                                                            class="icon-map-pin"></span>محصولات</label>
                                                <select class="js-example-basic-multiple tagSearch"
                                                        id="product_id"
                                                        name="product_id[]" multiple>
                                                    @foreach($productsInfo as $valAnswers)
                                                        <option
                                                                @if(isset($editValue))
                                                                @foreach($toursPackageInfo as $value)
                                                                @if($valAnswers->id==$value->product_id)
                                                                {{"selected"}}
                                                                @endif
                                                                @endforeach
                                                                @endif
                                                                value="{{$valAnswers->id}}">{{$valAnswers->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
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
                                            <label for="status"><span class="icon-map-pin"></span> وضعیت</label>
                                            <div class="select">
                                                <select id="status" name="status">
                                                    <option @if(isset($editValue)) @if($editValue->status==1){{'selected'}}@endif @else @if(old('status')==1){{'selected'}}@endif  @endif value="1">
                                                        فعال
                                                    </option>
                                                    <option @if(isset($editValue)) @if($editValue->status==0){{'selected'}}@endif @endif value="0">
                                                        غیر فعال
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
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
                                 @if(isset($editValue)) style="background-image: url('{{asset('files/products/'.$editValue->images)}}');"@endif>
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
            <link href="{{asset('files/uploader/jquery.fileuploader.css')}}" media="all" rel="stylesheet">
            <link href="{{asset('files/uploader/thumbnails/css/jquery.fileuploader-theme-thumbnails.css')}}" media="all"
                  rel="stylesheet">
        @endsection
        @section('script')

            <script src="{{asset('js/dist/js/select2.js')}}"></script>
            <script src="{{asset('js/dist/js/select2.full.js')}}"></script>
            <script src="{{asset('js/tagSearchList.js')}}"></script>
            <script>
                $('#group_features_id').on('change', function () {
                    var Data = {
                        group_features_id: this.value
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
            <script src="{{asset('files/uploader/jquery.fileuploader.min.js')}}" type="text/javascript"></script>
            <script src="{{asset('files/uploader/thumbnails/js/custom.js')}}" type="text/javascript"></script>
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
