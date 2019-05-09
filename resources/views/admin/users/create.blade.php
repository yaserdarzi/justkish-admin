@extends('layouts.pages')
@section('title')
    @if(isset($editValue))
        {{'ویرایش حساب کاربری'}}
    @else
        {{'افزودن حساب کاربری'}}
    @endif
@endsection
@section('content')
    <!-- Page Header -->
    <form method="POST" action="{{url('users')}}@if(isset($editValue))/{{$editValue->id}}@endif"
          files="true" enctype="multipart/form-data">
        {!! csrf_field() !!}
        @if(isset($editValue))
            <input type="hidden" name="_method" value="PATCH">
        @endif
        <header class="page-header">
            <div class="content">
                <div class="title">
                    @if(isset($editValue))
                        <h1> ویرایش حساب کاربری </h1>
                    @else
                        <h1> افزودن حساب کاربری </h1>
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
                                            <label for="role_id"><span class="icon-map-pin"></span>  نوع حساب</label>
                                            <div class="select">
                                                <select id="role_id" name="role_id">
                                                    @foreach($roleUsersInfo as $value)
                                                        <option @if(isset($editValue)) @if($editValue->role_id == $value->id) {{'selected'}} @endif @endif  value="{{$value->id}}">{{$value->role_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="name"><span class="icon-map-pin"></span> نام</label>
                                            <input type="text" id="name" name="name" placeholder="نام"
                                                   value="{{old('name')}}@if(isset($editValue)){{$editValue->name}}@endif"
                                                   class="title lg">
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="phone"><span class="icon-map-pin"></span>شماره همراه</label>
                                            <input type="text" id="phone" name="phone" placeholder="شماره همراه" maxlength="12"
                                                   onkeypress="return onlynumber(event);"
                                                   value="@if(isset($editValue)){{$editValue->phone}}@else{{old('phone')}}@endif"
                                                   class="title lg">
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="activated"><span class="icon-map-pin"></span> وضعیت</label>
                                            <div class="select">
                                                <select id="activated" name="activated">
                                                    <option @if(isset($editValue)) @if($editValue->activated==1){{'selected'}}@endif @endif @if(old('activated')==1){{'selected'}}@endif value="1">
                                                        فعال
                                                    </option>
                                                    <option @if(isset($editValue)) @if($editValue->activated==0){{'selected'}}@endif @endif value="0">
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
    </form>
@endsection
