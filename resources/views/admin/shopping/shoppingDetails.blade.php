@extends('layouts.pages')
@section('footer')
    <script src="{{asset('js/tinymce/tinymce.min.js')}}"></script>
@endsection
@section('content')
    <!-- Page Header -->
    <header class="page-header">
        <div class="content">
            <div class="title">
                <h1> جزییات فاکتور:{{$payment_token}}</h1>
            </div>
        </div>
    </header>
    <!-- START: Main Content -->
    <div class="main-content">
        <div class="row">
            <div class="col-sm-12">
                <!-- Form General -->
                <section class="panel">

                    @if($shopping)
                        <section class="panel">
                            <article class="p0">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>نام فیلم</th>
                                        <th>تعداد سفارش</th>
                                        <th>قیمت واحد</th>
                                        <th>جمع کل</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($shopping as $list)
                                        <tr>
                                            <td>{{$list->title}}</td>
                                            <td>{{$list->count}}</td>
                                            <td>{{$list->price}}</td>
                                            <td>{{$list->price*$list->count}}</td>


                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </article>
                        </section>
                    @endif
                </section>
            </div>
        </div>

    </div>
    <!-- END: Main Content -->

@endsection