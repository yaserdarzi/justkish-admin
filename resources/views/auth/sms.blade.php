@extends('layouts.auth')
@section('content')

    <div class="container">
        <div id="logo-big">
            <a href="#"> <img src="{{asset('img/logo.png')}}" alt="justkish" width="100%"> </a>
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


        <section class="panel">
            <header>
                <div class="title"> ورود</div>
            </header>
            <article>
                {{--<div class="row social-logins">--}}
                {{--<div class="col-sm-6"><a href="#" class="button block labeled google-plus"><span class="icon-google-plus"></span> ورود با گوگل </a></div>--}}
                {{--<div class="col-sm-6"><a href="#" class="button block labeled facebook"><span class="icon-facebook"></span> ورود با فیسبوک </a></div>--}}
                {{--</div>--}}
                {{--<hr class="or">--}}
                <form method="POST" action="{{url('auth/sms')}}">
                    {!! csrf_field() !!}
                    <div class="field icon right lg ">
                        <input type="text" data-type="onlyNumber" maxlength="11"
                               name="phone" value="{{ old('phone') }}" placeholder="تلفن همراه">
                        <div class="icon-user"></div>
                    </div>
                    <footer>
                        <button class="purple f-r" type="submit"> ورود</button>
                        {{--<div class="checkbox f-r error"> <input id="check-1" type="checkbox" name="field" value="check"> <label for="check-1"> قوانین و شرایط سایت را می‌پذیرم </label> </div>--}}
                    </footer>
                </form>


            </article>

        </section>
        {{--<div class="auth-footer"> <a href="#"> بازیابی رمز عبور </a> <span>•</span> <a href="#"> ورود </a> </div>--}}
    </div>

@endsection