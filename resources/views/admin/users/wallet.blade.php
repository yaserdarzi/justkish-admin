@extends('layouts.pages')
@section('title')
    {{'افزایش و کاهش  کیف پول'}}
@endsection
@section('content')
    <!-- Page Header -->
    <form method="POST" action="{{url('users')}}/{{$wallet->user_id}}/wallet"
          files="true" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <header class="page-header">
            <div class="content">
                <div class="title">
                    <h1> افزایش و کاهش کیف پول </h1>
                </div>
                <div class="functions">
                    <button class="purple"> ثبت</button>
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
                                            <label><span class="icon-map-pin"></span> مبلغ کیف پول</label>
                                            <label class="title lg">{{number_format($wallet->wallet_price)}}</label>
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label id="status"><span class="icon-map-pin"></span> نوع</label>
                                            <select class="title lg" id="status" name="status">
                                                <option value="1">شارژ</option>
                                                <option value="-1">برداشت</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="price"><span class="icon-map-pin"></span> مبلغ </label>
                                            <input type="text" id="price" name="price" placeholder="مبلغ "
                                                   value=""
                                                   onkeyup="javascript:this.value=Number_Three_digit(this.value);"
                                                   onkeypress="return onlynumber(event);" class="title lg">
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