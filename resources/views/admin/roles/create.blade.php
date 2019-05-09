@extends('layouts.pages')
@section('title')
    @if(isset($editValue))
        {{'ویرایش نقش'}}
    @else
        {{'افزودن نقش'}}
    @endif
@endsection
@section('content')
    <!-- Page Header -->
    <form method="POST" action="{{url('user/roles')}}@if(isset($editValue))/{{$editValue->id}}@endif">
        {{ csrf_field() }}
        @if(isset($editValue))
            <input type="hidden" name="_method" value="PATCH">
        @endif
        <header class="page-header">
            <div class="content">
                <div class="title">
                    @if(isset($editValue))
                        <h1> ویرایش نقش </h1>
                    @else
                        <h1> افزودن نقش </h1>
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
                                            <label><span class="icon-lock"></span> مجوز ها </label>
                                            <div class="checkboxes">
                                                <div class="checkbox checkbox-inline checkbox-all-toggle">
                                                    <input id="check-all"
                                                           type="checkbox" @if(isset($editValue)) @if($checkAll){{'checked'}}@endif @endif >
                                                    <label for="check-all">همه </label>
                                                </div>
                                                @foreach($permissionsInfo as $key=>$value)
                                                    <div class="checkbox checkbox-inline">
                                                        <input id="check-{{$value->id}}" name="permission_id[]"
                                                               @if(isset($editValue)) @foreach($role_permissions as $role_permission) @if($value->id==$role_permission->permission_id){{'checked'}}@endif @endforeach @endif
                                                               value="{{$value->id}}" type="checkbox">
                                                        <label for="check-{{$value->id}}"> {{$value->route_name}} </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="role_name"><span class="icon-map-pin"></span> عنوان</label>
                                            <input type="text" id="role_name" name="role_name" placeholder="عنوان"
                                                   value="{{old('role_name')}}@if(isset($editValue)){{$editValue->role_name}}@endif"
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