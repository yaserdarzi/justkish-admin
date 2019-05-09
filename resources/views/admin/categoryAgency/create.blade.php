@extends('layouts.pages')
@section('title')
    @if(isset($editValue))
        {{'ویرایش دسته بندی آژانس'}}
    @else
        {{'افزودن دسته بندی آژانس'}}
    @endif
@endsection
@section('content')
    <!-- Page Header -->
    <form method="POST" action="{{url('categoryAgency')}}@if(isset($editValue))/{{$editValue->id}}@endif"
          files="true" enctype="multipart/form-data">
        {!! csrf_field() !!}
        @if(isset($editValue))
            <input type="hidden" name="_method" value="PATCH">
        @endif
        <header class="page-header">
            <div class="content">
                <div class="title">
                    @if(isset($editValue))
                        <h1> ویرایش دسته بندی آژانس </h1>
                    @else
                        <h1> افزودن دسته بندی آژانس </h1>
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
                                            <label for="title"><span class="icon-map-pin"></span> عنوان</label>
                                            <input type="text" id="title" name="title" placeholder="عنوان"
                                                   value="@if(isset($editValue)){{$editValue->title}}@else{{old('title')}}@endif"
                                                   class="title lg">
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="percent"><span class="icon-map-pin"></span>
                                                درصد</label>
                                            <input type="text" id="percent" name="percent" placeholder="درصد" maxlength="2"
                                                   onkeypress="return onlynumber(event);"
                                                   value="@if(isset($editValue)){{$editValue->percent}}@else{{old('percent')}}@endif"
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
