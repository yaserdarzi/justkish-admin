@extends('layouts.pages')
@section('title'){{'قیمت'}}@endsection
@section('content')
    <!-- Page Header -->
    <header class="page-header">
        <div class="content">
            <div class="title">
                <h1> قیمت </h1>
                <h6 class="desc">قیمت </h6></div>
            <div class="functions">
                <div class="field icon sm">
                    <input type="text" data-table="table" class="search" placeholder="جستجو...">
                    <a href="#" class="icon-search"></a>
                </div>
                <button onclick="location.href='{{url('tours')}}';" class="white labeled"><span
                            class="icon-arrow-right"></span> بازگشت
                </button>
                <button onclick="location.href='{{url('tours/'.$tour_id.'/priceAgeRange/create')}}';" class="green labeled"><span
                            class="icon-plus"></span> افزودن
                </button>
            </div>
        </div>
    </header>
    <div class="main-content">
        <section class="panel">
            <article class="p0">
                <table class="table">
                    <thead>
                    <tr>
                        <th class="tac">#</th>
                        <th>عنوان</th>
                        <th>حداقل سن</th>
                        <th>حداکثر سن</th>
                        <th>مبلغ</th>
                        <th>تاریخ</th>
                        <th class="list-icon-button"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tourPriceAgeRangeInfo as $key=>$value)
                        <tr>
                            <td class="tac"><a href="#">{{$key+1}}</a></td>
                            <td>{{$value->title}}</td>
                            <td>{{$value->min}}</td>
                            <td>{{$value->max}}</td>
                            <td>{{number_format($value->price)}}</td>
                            <td class="column-time">{{jDate::forge(date('Y/m/d', (integer)$value->created_at))->format('%d %B %Y')}}</td>
                            <td class="td-button" style="width: 100px;">
                                <a id="{{$value->id}}" onclick="deleteFunction(this.id);"
                                   class="button red icon-trash"></a>
                                <form id="form-delete-priceAgeRange-{{$value->id}}"
                                      action="{{url('tours/'.$tour_id.'/priceAgeRange/'.$value->id)}}" method="post">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="_method" value="DELETE">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </article>
        </section>
    </div>
@endsection
@section('script')
    <script>
        function deleteFunction(id) {
            var r = confirm("کاربر گرامی ، آبا می خواهید فیلد مورد نظر را حذف نماید؟");
            if (r == true) {
                document.forms["form-delete-priceAgeRange-" + id].submit();
            }
        }
    </script>
@endsection