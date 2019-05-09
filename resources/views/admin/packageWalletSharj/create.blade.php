@extends('layouts.pages')
@section('title')
    @if(isset($editValue))
        {{'ویرایش پکیج شارژ'}}
    @else
        {{'افزودن پکیج شارژ'}}
    @endif
@endsection
@section('content')
    <!-- Page Header -->
    <form method="POST" action="{{url('packageWalletSharj')}}@if(isset($editValue))/{{$editValue->id}}@endif"
          files="true" enctype="multipart/form-data">
        {!! csrf_field() !!}
        @if(isset($editValue))
            <input type="hidden" name="_method" value="PATCH">
        @endif
        <header class="page-header">
            <div class="content">
                <div class="title">
                    @if(isset($editValue))
                        <h1> ویرایش پکیج شارژ </h1>
                    @else
                        <h1> افزودن پکیج شارژ </h1>
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
                                                   value="{{old('title')}}@if(isset($editValue)){{$editValue->title}}@endif"
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
                                                   value="@if(isset($editValue)){{number_format($editValue->price)}}@else{{number_format(old('price'))}}@endif"
                                                   class="title lg">
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="percent"><span class="icon-map-pin"></span>
                                                تخفیف</label>
                                            <input type="text" id="percent" name="percent" placeholder="تخفیف"
                                                   onkeypress="return onlynumber(event);"
                                                   onkeyup="javascript:this.value=Number_Three_digit(this.value);"
                                                   value="@if(isset($editValue)){{number_format($editValue->percent)}}@else{{number_format(old('percent'))}}@endif"
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