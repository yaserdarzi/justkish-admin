@extends('layouts.pages')
@section('title')
    @if(isset($editValue))
        {{'ویرایش قیمت'}}
    @else
        {{'افزودن قیمت'}}
    @endif
@endsection
@section('content')
    <!-- Page Header -->
    <form method="POST"
          action="{{url('products/'.$product_id.'/priceAgeRange')}}@if(isset($editValue))/{{$editValue->id}}@endif"
          files="true" enctype="multipart/form-data">
        {!! csrf_field() !!}
        @if(isset($editValue))
            <input type="hidden" name="_method" value="PATCH">
        @endif
        <header class="page-header">
            <div class="content">
                <div class="title">
                    @if(isset($editValue))
                        <h1> ویرایش قیمت </h1>
                    @else
                        <h1> افزودن قیمت </h1>
                    @endif
                </div>
                <div class="functions">
                    <button onclick="location.href='{{url('products/'.$product_id.'/priceAgeRange')}}';"
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
                                            <label for="title"><span class="icon-map-pin"></span> عنوان</label>
                                            <input type="text" id="title" name="title" placeholder="عنوان"
                                                   value="{{old('title')}}@if(isset($editValue)){{$editValue->title}}@endif"
                                                   class="title lg">
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="min"><span class="icon-map-pin"></span> حداقل سن</label>
                                            <input type="text" id="min" name="min" placeholder="حداقل سن"
                                                   onkeypress="return onlynumber(event);"
                                                   value="{{old('min')}}@if(isset($editValue)){{$editValue->min}}@endif"
                                                   class="title lg">
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="max"><span class="icon-map-pin"></span> حداکثر سن</label>
                                            <input type="text" id="max" name="max" placeholder="حداکثر سن"
                                                   onkeypress="return onlynumber(event);"
                                                   value="{{old('max')}}@if(isset($editValue)){{$editValue->max}}@endif"
                                                   class="title lg">
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="price"><span class="icon-map-pin"></span>
                                                مبلغ</label>
                                            <input type="text" id="price" name="price" placeholder="مبلغ"
                                                   onkeypress="return onlynumber(event);"
                                                   onkeyup="javascript:this.value=Number_Three_digit(this.value);"
                                                   value="@if(isset($editValue)){{$editValue->price}}@else{{old('price')}}@endif"
                                                   class="title lg">
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
