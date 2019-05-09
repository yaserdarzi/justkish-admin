@extends('layouts.pages')
@section('title'){{'نقش کاربران'}}@endsection
@section('content')
    <!-- Page Header -->
    <header class="page-header">
        <div class="content">
            <div class="title">
                <h1> نقش کاربران </h1>
                <h6 class="desc">نقش کاربران </h6></div>
            <div class="functions">
                <div class="field icon sm">
                    <input type="text" data-table="table" class="search" placeholder="جستجو...">
                    <a href="#" class="icon-search"></a>
                </div>
                @if(true==true)
                    <button onclick="location.href='{{url('user/permissions')}}';" class="labeled"><span
                                class="icon-eye"></span> نمایش مجوزها
                    </button>
                @endif
                <button onclick="location.href='{{url('user/roles/create')}}';" class="green labeled"><span
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
                        <th>مجوز ها</th>
                        <th>تاریخ ثبت</th>
                        <th>تاریخ بروز رسانی</th>
                        <th class="list-icon-button"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rolesInfo as $key=>$value)
                        <tr>
                            <td class="tac"><a href="#">{{$key+1}}</a></td>
                            <td>{{$value->role_name}}</td>
                            <td>{{$value->permissions}}</td>
                            <td class="column-time">{{jDate::forge(date('Y/m/d', (integer)$value->created_at))->format('%d %B %Y')}}</td>
                            <td class="column-time">{{jDate::forge(date('Y/m/d', (integer)$value->updated_at))->format('%d %B %Y')}}</td>
                            <td class="td-button">
                                <a href="{{url('user/roles/'.$value->id.'/edit')}}"
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
                @if($rolesInfo->hasPages())
                    <?php echo $rolesInfo->render();?>
                @endif
            </ul>
        </div>
    </div>
@endsection
