@extends('layouts.pages')
@section('title')
    @if(isset($editValue))
        {{'ویرایش ویژگی'}}
    @else
        {{'افزودن ویژگی'}}
    @endif
@endsection
@section('content')
    <!-- Page Header -->
    <form method="POST" action="{{url('features')}}@if(isset($editValue))/{{$editValue->id}}@endif"
          files="true" enctype="multipart/form-data">
        {!! csrf_field() !!}
        @if(isset($editValue))
            <input type="hidden" name="_method" value="PATCH">
        @endif
        <header class="page-header">
            <div class="content">
                <div class="title">
                    @if(isset($editValue))
                        <h1> ویرایش ویژگی </h1>
                    @else
                        <h1> افزودن ویژگی </h1>
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
                <div class="col-sm-12">
                    <!-- Form General -->
                    <section class="panel form-general">
                        <article>
                            <ul class="tabs-contents">
                                <li id="tab-lang-fa">
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="group_features_id"><span class="icon-map-pin"></span>گروه ویژگی
                                                ها</label>
                                            <div class="select">
                                                <select id="group_features_id" name="group_features_id">
                                                    @if(isset($groupFeaturesInfo))
                                                        @foreach($groupFeaturesInfo as $key=>$value)
                                                            <option @if(isset($editValue)) @if($editValue->group_features_id==$value->id){{'selected'}}@endif @else @if(old('group_features_id')==$value->title){{'selected'}}@endif @endif  value="{{$value->id}}">{{$value->title}}</option>
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
                                                   value="{{old('title')}}@if(isset($editValue)){{$editValue->title}}@endif"
                                                   class="title lg">
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="description"><span class="icon-map-pin"></span> توضیحات</label>
                                            <textarea type="text" id="description" name="description"
                                                      placeholder="توضیحات"
                                                      class="title lg">{{old('description')}}@if(isset($editValue)){{$editValue->description}}@endif</textarea>
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