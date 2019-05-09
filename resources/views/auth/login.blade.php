<!-- resources/views/auth/login.blade.php -->
@extends('layouts.auth')

@section('content')

    <div class="container">
        <div id="logo-big">
            <a href="#"> <img src="{{asset('img/vishar-logo-name.png')}}" alt="vishar" width="100%"> </a>
        </div>
        <!-- Messages -->
        @foreach ($errors->all() as $error)

            <div class="alert red icon-exclamation">
                <ul>
                    <li>{{ $error }}</li>
                </ul>
                <ul>

                </ul>
            </div>
        @endforeach
        @if(Session::get('error')!=null)
            <div class="alert red icon-exclamation">
                <ul>
                    <li>{{Session::get('error')}}</li>
                </ul>
            </div>
        @endif

        <section class="panel">
            <header>
                <div class="title"><span> ورود / </span><a href="{{url('auth/register')}}">ثبت نام</a></div>
            </header>
            <article>
                {{--<div class="row social-logins">--}}
                {{--<div class="col-sm-6"><a href="#" class="button block labeled google-plus"><span class="icon-google-plus"></span> ورود با گوگل </a></div>--}}
                {{--<div class="col-sm-6"><a href="#" class="button block labeled facebook"><span class="icon-facebook"></span> ورود با فیسبوک </a></div>--}}
                {{--</div>--}}
                {{--<hr class="or">--}}
                <form method="POST" action="{{url('auth/login')}}">
                    {!! csrf_field() !!}
                    <div class="field icon right lg "><input type="email" name="email" value="{{ old('email') }}"
                                                             placeholder="ایمیل">
                        <div class="icon-user"></div>
                    </div>

                    <div class="field icon right lg "><input type="password" name="password" id="password"
                                                             placeholder="گذرواژه">
                        <div class="icon-lock"></div>
                    </div>
                    <footer>
                        <button class="purple f-r" type="submit"> ورود</button>
                        {{--<div class="        " style="margin-right: 59px !important;"><label for="check-1">--}}

                        {{--رمز عبور را <a--}}
                        {{--href="{{url('/auth/forgetPassword')}}">فراموش</a> کردم--}}

                        {{--</label></div>--}}

                    </footer>


                </form>


            </article>

        </section>
        {{--<div class="auth-footer"> <a href="#"> بازیابی رمز عبور </a> <span>•</span> <a href="#"> ورود </a> </div>--}}
    </div>

@endsection
