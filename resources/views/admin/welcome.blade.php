@extends('layouts.pages')
@section('footer')
    <script src="{{asset('js/tinymce/tinymce.min.js')}}"></script>
@endsection
@section('content')
    <!-- Page Header -->

    <!-- START: Main Content -->
    {{--<div class="main-content">--}}
        {{--<div class="row">--}}

            {{--<div class="col-sm-4">--}}
                {{--<section class="panel tile violet alt">--}}
                    {{--<article> <span class="tile-icon icon-shopping-cart"></span>--}}
                        {{--<h2>{{$reports['allMoviesCount']}}</h2>--}}
                        {{--<h5> مجموع فیلم ها </h5> </article>--}}
                {{--</section>--}}
            {{--</div>--}}
            {{--<div class="col-sm-4">--}}
                {{--<section class="panel tile violet bar-violet">--}}
                    {{--<article> <span class="tile-icon icon-bar-chart"></span>--}}
                        {{--<h2>{{$reports['seriesCount']}}</h2>--}}
                        {{--<h5> سریال </h5> </article>--}}
                {{--</section>--}}
            {{--</div>--}}

            {{--<div class="col-sm-4">--}}
                {{--<section class="panel tile violet bar-violet">--}}
                    {{--<article> <span class="tile-icon icon-bar-chart"></span>--}}
                        {{--<h2>{{$reports['moviesCount']}}</h2>--}}
                        {{--<h5> فیلم </h5> </article>--}}
                {{--</section>--}}
            {{--</div>--}}


        {{--</div>--}}
        {{--<div class="row">--}}

            {{--<div class="col-sm-4">--}}
                {{--<section class="panel tile teal alt">--}}
                    {{--<article> <span class="tile-icon icon-shopping-cart"></span>--}}
                        {{--<h2>{{$reports['allSales']}}</h2>--}}
                        {{--<h5> مجموع فروش </h5> </article>--}}
                {{--</section>--}}
            {{--</div>--}}
            {{--<div class="col-sm-4">--}}
                {{--<section class="panel tile teal bar-teal">--}}
                    {{--<article> <span class="tile-icon icon-bar-chart"></span>--}}
                        {{--<h2>{{$reports['digitalSales']}}</h2>--}}
                        {{--<h5> فروش دیجیتال </h5> </article>--}}
                {{--</section>--}}
            {{--</div>--}}

            {{--<div class="col-sm-4">--}}
                {{--<section class="panel tile teal bar-teal">--}}
                    {{--<article> <span class="tile-icon icon-bar-chart"></span>--}}
                        {{--<h2>{{$reports['postSales']}}</h2>--}}
                        {{--<h5> فروش پستی </h5> </article>--}}
                {{--</section>--}}
            {{--</div>--}}


        {{--</div>--}}
    {{--</div>--}}
    <!-- END: Main Content -->

@endsection
