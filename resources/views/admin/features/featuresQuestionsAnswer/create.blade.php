@extends('layouts.pages')
@section('title')
    @if(isset($editValue))
        {{'ویرایش جواب ویژگی ها'}}
    @else
        {{'افزودن جواب ویژگی ها'}}
    @endif
@endsection
@section('content')
    <!-- Page Header -->
    <form method="POST"
          action="{{url('features/'.$features_id.'/answers')}}@if(isset($editValue))/{{$editValue->id}}@endif"
          files="true" enctype="multipart/form-data">
        {!! csrf_field() !!}
        @if(isset($editValue))
            <input type="hidden" name="_method" value="PATCH">
        @endif
        <header class="page-header">
            <div class="content">
                <div class="title">
                    @if(isset($editValue))
                        <h1> ویرایش جواب ویژگی ها </h1>
                    @else
                        <h1> افزودن جواب ویژگی ها </h1>
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
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="title"><span class="icon-map-pin"></span> عنوان</label>
                                            <input type="text" id="title" name="title" placeholder="عنوان"
                                                   value="{{old('title')}}@if(isset($editValue)){{$editValue->title}}@endif"
                                                   class="title lg">
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
                                 @if(isset($editValue)) style="background-image: url('{{asset('files/brand/'.$editValue->background_icon)}}');"@endif>
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
    </form>
@endsection