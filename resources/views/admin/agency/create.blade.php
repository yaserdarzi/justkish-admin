@extends('layouts.pages')
@section('title')
    @if(isset($editValue))
        {{'ویرایش آژانس'}}
    @else
        {{'افزودن آژانس'}}
    @endif
@endsection
@section('content')
    <!-- Page Header -->
    <form method="POST" action="{{url('agency')}}@if(isset($editValue))/{{$editValue->id}}@endif"
          files="true" enctype="multipart/form-data">
        {!! csrf_field() !!}
        @if(isset($editValue))
            <input type="hidden" name="_method" value="PATCH">
        @endif
        <header class="page-header">
            <div class="content">
                <div class="title">
                    @if(isset($editValue))
                        <h1> ویرایش آژانس </h1>
                    @else
                        <h1> افزودن آژانس </h1>
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
                                            <label for="category_agency_id"><span class="icon-map-pin"></span>دسته بندی</label>
                                            <div class="select">
                                                <select id="category_agency_id" name="category_agency_id">
                                                    @foreach($categoryAgencyInfo as $key=>$value)
                                                        <option
                                                            @if(isset($editValue)) @if($editValue->category_agency_id==$value->id){{'selected'}}@endif @else @if(old('category_agency_id')==$value->id){{'selected'}}@endif @endif  value="{{$value->id}}">{{$value->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="name"><span class="icon-map-pin"></span> نام</label>
                                            <input type="text" id="title" name="name" placeholder="نام"
                                                   value="@if(isset($editValue)){{$editValue->name}}@else{{old('name')}}@endif"
                                                   class="title lg">
                                        </div>
                                    </div>
                                    @if(isset($editValue))
                                    @else
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="email"><span class="icon-map-pin"></span> پست الکترونیک</label>
                                            <input type="text" id="email" name="email" placeholder="پست الکترونیک"
                                                   value="@if(isset($editValue)){{$editValue->email}}@else{{old('email')}}@endif"
                                                   class="title lg">
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="password"><span class="icon-map-pin"></span> گذرواژه</label>
                                            <input type="password" id="password" name="password"
                                                   placeholder="گذرواژه"
                                                   class="title lg">
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="rePassword"><span class="icon-map-pin"></span>تکرار
                                                گذرواژه</label>
                                            <input type="password" id="rePassword" name="rePassword"
                                                   placeholder="تکرار گذرواژه"
                                                   class="title lg">
                                        </div>
                                    </div>
                                    @endif
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="phone"><span class="icon-map-pin"></span>شماره همراه</label>
                                            <input type="text" id="phone" name="phone" placeholder="شماره همراه"
                                                   maxlength="11"
                                                   onkeypress="return onlynumber(event);"
                                                   value="@if(isset($editValue)){{$editValue->phone}}@else{{old('phone')}}@endif"
                                                   class="title lg">
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="tell"><span class="icon-map-pin"></span>شماره تماس</label>
                                            <input type="text" id="tell" name="tell" placeholder="شماره تماس"
                                                   maxlength="11"
                                                   onkeypress="return onlynumber(event);"
                                                   value="@if(isset($editValue)){{$editValue->tell}}@else{{old('tell')}}@endif"
                                                   class="title lg">
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="status"><span class="icon-map-pin"></span> وضعیت</label>
                                            <div class="select">
                                                <select id="status" name="status">
                                                    <option
                                                        @if(isset($editValue)) @if($editValue->status==1){{'selected'}}@endif @else @if(old('status')==1){{'selected'}}@endif  @endif value="1">
                                                        فعال
                                                    </option>
                                                    <option
                                                        @if(isset($editValue)) @if($editValue->status==0){{'selected'}}@endif @endif value="0">
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
            </div>
        </div>
    {{--</form>--}}
@endsection
