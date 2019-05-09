@extends('layouts.pages')
@section('title')
    @if(isset($editValue))
        {{'ویرایش عرضه کننده'}}
    @else
        {{'افزودن عرضه کننده'}}
    @endif
@endsection
@section('content')
    <!-- Page Header -->
    <form method="POST"
          action="{{url('tours/'.$tour_id.'/supplier')}}@if(isset($editValue))/{{$editValue->id}}@endif"
          files="true" enctype="multipart/form-data">
        {!! csrf_field() !!}
        @if(isset($editValue))
            <input type="hidden" name="_method" value="PATCH">
        @endif
        <header class="page-header">
            <div class="content">
                <div class="title">
                    @if(isset($editValue))
                        <h1> ویرایش عرضه کننده </h1>
                    @else
                        <h1> افزودن عرضه کننده </h1>
                    @endif
                </div>
                <div class="functions">
                    <button onclick="location.href='{{url('tours/'.$tour_id.'/supplier')}}';"
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
                                            <label for="userInfo"><span class="icon-map-pin"></span>عرضه
                                                کننده</label>
                                            <div class="select">
                                                <select id="userInfo" name="userInfo">
                                                    @foreach($userInfo as $key=>$value)
                                                        <option @if(isset($editValue)) @if($editValue->user_id==$value->user_id){{'selected'}}@endif @else @if(old('user_id')==$value->user_id){{'selected'}}@endif @endif  value="{{$value->user_id}}">{{$value->user_id .'-'.$value->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="percent"><span class="icon-map-pin"></span>  درصد دریافتی شما</label>
                                            <input type="text" id="percent" name="percent" placeholder="درصد دریافتی شما"
                                                   onkeypress="return onlynumber(event);" maxlength="2"
                                                   value="{{old('percent')}}@if(isset($editValue)){{$editValue->percent}}@endif"
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
