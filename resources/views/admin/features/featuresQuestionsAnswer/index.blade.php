@extends('layouts.pages')
@section('title'){{'جواب ویژگی ها'}}@endsection
@section('content')
    <!-- Page Header -->
    <header class="page-header">
        <div class="content">
            <div class="title">
                <h1> جواب ویژگی ها </h1>
                <h6 class="desc">جواب ویژگی ها </h6></div>
            <div class="functions">
                <div class="field icon sm">
                    <input type="text" data-table="table" class="search" placeholder="جستجو...">
                    <a href="#" class="icon-search"></a>
                </div>
                <button onclick="location.href='{{url('features/'.$features_id.'/answers/create')}}';"
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
                        <th>عنوان</th>
                        <th>تصویر</th>
                        <th>تاریخ</th>
                        <th class="list-icon-button"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($featuresQuestionsAnswersInfo as $key=>$value)
                        <tr>
                            <td class="tac"><a href="#">{{$key+1}}</a></td>
                            <td>{{$value->title}}</td>
                            <td>
                                @if($value->image!=null)
                                    <img style="width: 50px; height: 50px;"
                                         src="{{config('app.cdn_image_url').'/files/features/'.$features_id.'/answers/'.$value->image}}"/>
                                @endif
                            </td>
                            <td class="column-time">{{jDate::forge(date('Y/m/d', (integer)$value->created_at->timestamp))->format('%d %B %Y')}}</td>
                            <td class="td-button" style="width: 100px;">
                                <a href="{{url('features/'.$features_id.'/answers/'.$value->id.'/edit')}}"
                                   class="button green icon-pencil"></a>
                                <a id="{{$value->id}}" onclick="deleteFunction(this.id);"
                                   class="button red icon-trash"></a>
                                <form id="form-delete-brand-{{$value->id}}"
                                      action="{{url('features/'.$features_id.'/answers/'.$value->id)}}" method="post">
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
                document.forms["form-delete-brand-" + id].submit();
            }
        }
    </script>
@endsection