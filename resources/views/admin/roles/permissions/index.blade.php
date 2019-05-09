@extends('layouts.pages')
@section('title'){{'مجوز'}}@endsection
@section('content')
    <!-- Page Header -->
    <header class="page-header">
        <div class="content">
            <div class="title">
                <h1> مجوز </h1>
                <h6 class="desc">مجوز </h6></div>
            <div class="functions">
                <div class="field icon sm">
                    <input type="text" data-table="table" class="search" placeholder="جستجو...">
                    <a href="#" class="icon-search"></a>
                </div>
                <button onclick="location.href='{{url('user/permissions/create')}}';" class="green labeled"><span
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
                        <th>توضیحات</th>
                        <th>تاریخ ثبت</th>
                        <th>تاریخ بروز رسانی</th>
                        <th class="list-icon-button"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permissionsInfo as $key=>$value)
                        <tr>
                            <td class="tac"><a href="#">{{$key+1}}</a></td>
                            <td>{{$value->route_name}}</td>
                            <td>{{$value->description}}</td>
                            <td class="column-time">{{jDate::forge(date('Y/m/d', (integer)$value->created_at))->format('%d %B %Y')}}</td>
                            <td class="column-time">{{jDate::forge(date('Y/m/d', (integer)$value->updated_at))->format('%d %B %Y')}}</td>
                            <td class="td-button">
                                <a href="{{url('user/permissions/'.$value->id.'/edit')}}"
                                   class="button green icon-pencil"></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </article>
        </section>
        <div class="paginate tal">
            <ul class="pagination">
                @if($permissionsInfo->hasPages())
                    <?php echo $permissionsInfo->render();?>
                @endif
            </ul>
        </div>
    </div>
@endsection
