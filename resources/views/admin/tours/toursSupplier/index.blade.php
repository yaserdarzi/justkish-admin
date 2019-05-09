@extends('layouts.pages')
@section('title'){{'عرضه کننده'}}@endsection
@section('content')
    <!-- Page Header -->
    <header class="page-header">
        <div class="content">
            <div class="title">
                <h1> عرضه کننده </h1>
                <h6 class="desc">عرضه کننده </h6></div>
            <div class="functions">
                <div class="field icon sm">
                    <input type="text" data-table="table" class="search" placeholder="جستجو...">
                    <a href="#" class="icon-search"></a>
                </div>
                <button onclick="location.href='{{url('tours')}}';" class="white labeled"><span
                            class="icon-arrow-right"></span> بازگشت
                </button>
                <button onclick="location.href='{{url('tours/'.$tour_id.'/supplier/create')}}';"
                        class="green labeled"><span
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
                        <th>عرضه کننده</th>
                        <th>درصد دریافتی شما</th>
                        <th>تاریخ</th>
                        <th class="list-icon-button"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tourSupplierInfo as $key=>$value)
                        <tr>
                            <td class="tac"><a href="#">{{$key+1}}</a></td>
                            <td>{{$value->name}}</td>
                            <td>{{$value->percent}}</td>
                            <td class="column-time">{{jDate::forge(date('Y/m/d', $value->created_at->timestamp))->format('%d %B %Y')}}</td>
                            <td class="td-button" style="width: 100px;">
                                <a href="{{url('tours/'.$tour_id.'/supplier/'.$value->id.'/edit')}}"
                                   class="button green icon-pencil"></a>
                                <a id="{{$value->id}}" onclick="deleteFunction(this.id);"
                                   class="button red icon-trash"></a>
                                <form id="form-delete-supplier-{{$value->id}}"
                                      action="{{url('tours/'.$tour_id.'/supplier/'.$value->id)}}"
                                      method="post">
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
                document.forms["form-delete-supplier-" + id].submit();
            }
        }
    </script>
@endsection