@extends('layouts.pages')
@section('title')
    @if(isset($editValue))
        {{'ویرایش پلن'}}
    @else
        {{'افزودن پلن'}}
    @endif
@endsection
@section('content')
    <!-- Page Header -->
    <form method="POST"
          action="{{url('category/'.$category_id.'/plan')}}@if(isset($editValue))/{{$editValue->id}}@endif"
          files="true" enctype="multipart/form-data">
        {!! csrf_field() !!}
        @if(isset($editValue))
            <input type="hidden" name="_method" value="PATCH">
        @endif
        <header class="page-header">
            <div class="content">
                <div class="title">
                    @if(isset($editValue))
                        <h1> ویرایش پلن </h1>
                    @else
                        <h1> افزودن پلن </h1>
                    @endif
                </div>
                <div class="functions">
                    <button onclick="location.href='{{url('category/'.$category_id.'/plan')}}';"
                            type="button"
                            class="white"> بازگشت
                    </button>
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
                <div class="col-sm-12">
                    <!-- Form General -->
                    <section class="panel form-general">
                        <article>
                            <ul class="tabs-contents">
                                <li id="tab-lang-fa">

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
                                            <label for="title"><span class="icon-map-pin"></span> عنوان</label>
                                            <input type="text" id="title" name="title" placeholder="عنوان"
                                                   value="{{old('title')}}@if(isset($editValue)){{$editValue->title}}@endif"
                                                   class="title lg">
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="price"><span class="icon-map-pin"></span> قیمت </label>
                                            <input type="text" id="price" name="price" placeholder="قیمت"
                                                   onkeypress="return onlynumber(event);"
                                                   onkeyup="javascript:this.value=Number_Three_digit(this.value);"
                                                   value="@if(isset($editValue)){{number_format($editValue->price)}}@endif"
                                                   class="title lg">
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="min"><span class="icon-map-pin"></span> کمترین</label>
                                            <input type="text" id="min" name="min"
                                                   placeholder="کمترین"
                                                   onkeypress="return onlynumber(event);"
                                                   value="{{old('min')}}@if(isset($editValue)){{$editValue->min}}@endif"
                                                   class="title lg">
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="max"><span class="icon-map-pin"></span>بیشترین</label>
                                            <input type="text" id="max" name="max"
                                                   placeholder="بیشترین"
                                                   onkeypress="return onlynumber(event);"
                                                   value="{{old('max')}}@if(isset($editValue)){{$editValue->max}}@endif"
                                                   class="title lg">
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="desc"><span class="icon-map-pin"></span> توضیحات</label>
                                            <textarea type="text" id="desc" name="desc"
                                                      placeholder="توضیحات" rows="5"
                                                      class="title lg">{{old('desc')}}@if(isset($editValue)){{$editValue->desc}}@endif</textarea>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </article>
                    </section>
                </div>
            </div>
        </div>
    </form>
@endsection