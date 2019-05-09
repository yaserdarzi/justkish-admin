@extends('layouts.pages')
@section('title'){{'گروه بندی'}}@endsection
@section('content')
    <!-- Page Header -->
    <header class="page-header">
        <div class="content">
            <div class="title">
                <h1> گروه بندی </h1>
                <h6 class="desc">گروه بندی </h6></div>
            <div class="functions">
                <div class="field icon sm">
                    <input type="text" data-table="table" class="search" placeholder="جستجو...">
                    <a href="#" class="icon-search"></a>
                </div>
                <button onclick="location.href='{{url('category/create')}}';" class="green labeled"><span
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
                        <th>قیمت فی</th>
                        <th>تصویر</th>
                        <th>ترتیب نمایش</th>
                        <th>تاریخ</th>
                        <th class="list-icon-button"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categoryInfo as $key=>$value)
                        <tr>
                            <td class="tac"><a href="#">{{$key+1}}</a></td>
                            <td>{{$value->title}}</td>
                            <td>{{number_format($value->pay)}}</td>
                            <td>
                                @if($value->icon!=null)
                                    <img style="width: 50px; height: 50px;"
                                         src="{{config('app.cdn_image_url').'/files/category/'.$value->icon}}"/>
                                @endif
                            </td>
                            <td>{{$value->sort}}</td>
                            <td class="column-time">{{jDate::forge(date('Y/m/d', (integer)$value->created_at->timestamp))->format('%d %B %Y')}}</td>
                            <td class="td-button" style="width: 180px;">
                                <a href="{{url('category/'.$value->id.'/timing')}}"
                                   class="button blue icon-clock-o"></a>
                                <a href="{{url('category/'.$value->id.'/plan')}}"
                                   class="button blue icon-list"></a>
                                <a href="{{url('category/'.$value->id.'/edit')}}"
                                   class="button green icon-pencil"></a>
                                <a id="{{$value->id}}" onclick="deleteFunction(this.id);"
                                   class="button red icon-trash"></a>
                                <form id="form-delete-category-{{$value->id}}"
                                      action="{{url('category/'.$value->id)}}" method="post">
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
                document.forms["form-delete-category-" + id].submit();
            }
        }
    </script>
@endsection