@extends('layouts.pages')
@section('title')
    @if(isset($editValue))
        {{'ویرایش مجوز'}}
    @else
        {{'افزودن مجوز'}}
    @endif
@endsection
@section('content')
    <!-- Page Header -->
    <form method="POST" action="{{url('user/permissions')}}@if(isset($editValue))/{{$editValue->id}}@endif">
        {{ csrf_field() }}
        @if(isset($editValue))
            <input type="hidden" name="_method" value="PATCH">
        @endif
        <header class="page-header">
            <div class="content">
                <div class="title">
                    @if(isset($editValue))
                        <h1> ویرایش مجوز </h1>
                    @else
                        <h1> افزودن مجوز </h1>
                    @endif
                </div>
                <div class="functions">
                    <a href="{{url('user/permissions')}}" class="button">بازگشت</a>
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
                                            <label for="route_name"><span class="icon-map-pin"></span> عنوان</label>
                                            <input type="text" id="route_name" name="route_name" placeholder="عنوان"
                                                   value="{{old('route_name')}}@if(isset($editValue)){{$editValue->route_name}}@endif"
                                                   class="title lg">
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="description"><span class="icon-map-pin"></span> توضیحات</label>
                                            <input type="text" id="description" name="description" placeholder="توضیحات"
                                                   value="{{old('description')}}@if(isset($editValue)){{$editValue->description}}@endif"
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
    {{--</form>--}}
@endsection
