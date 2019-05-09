@extends('layouts.pages')
@section('title'){{'حساب کاربری'}}@endsection
@section('content')
    <!-- Page Header -->
    <header class="page-header">
        <div class="content">
            <div class="title">
                <h1> حساب کاربری </h1>
                <h6 class="desc">حساب کاربری </h6></div>
            <div class="functions">
                <div class="field icon sm">
                    <input type="text" data-table="table" class="search" placeholder="جستجو...">
                    <a href="#" class="icon-search"></a>
                </div>
                <button onclick="location.href='{{url('users/create')}}';" class="green labeled"><span
                            class="icon-plus"></span> افزودن
                </button>
            </div>
        </div>
        <ul class="header-tabs">
            <li @if($active==1)class="active"@endif><a href="{{url('users')}}">ادمین</a></li>
            <li @if($active==2)class="active"@endif><a href="{{url('users/2')}}"> کاربر</a></li>
            <li @if($active==3)class="active"@endif><a href="{{url('users/3')}}">عرضه کننده</a></li>
        </ul>
    </header>
    <div class="main-content">
        <section class="panel">
            <article class="p0">
                <table class="table">
                    <thead>
                    <tr>
                        <th class="tac">#</th>
                        <th>عنوان</th>
                        <th>شماره همراه</th>
                        <th>نوع حساب</th>
                        <th>وضعیت</th>
                        <th class="list-icon-button"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($usersInfo as $key=>$value)
                        <tr>
                            <td class="tac"><a href="#">{{$key+1}}</a></td>
                            <td>{{$value->name}}</td>
                            <td>{{$value->phone}}</td>
                            <td>
                                @if($active==1)
                                    {{'ادمین'}}
                                @elseif($active==2)
                                    {{'کاربر'}}
                                @elseif($active==3)
                                    {{'عرضه کننده'}}
                                @endif
                            </td>
                            <td>
                                @if($value->activated==0)
                                    {{'غیر فعال'}}
                                @elseif($value->activated==1)
                                    {{'فعال'}}
                                @endif
                            </td>
                            <td class="td-button" style="width: 280px;">
                                <button onclick="location.href='{{url('users/'.$value->user_id.'/wallet')}}';"
                                        class="blue labeled"><span
                                            class="icon-dollar"></span>کیف پول
                                </button>
                                <button onclick="location.href='{{url('users/'.$value->user_id.'/credit')}}';"
                                        class="blue labeled"><span
                                            class="icon-dollar"></span> اعتبار
                                </button>
                                <a href="{{url('users/'.$value->user_id.'/edit')}}"
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
                @if($usersInfo->hasPages())
                    <?php echo $usersInfo->render();?>
                @endif
            </ul>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function deleteFunction(id) {
            var r = confirm("کاربر گرامی ، آبا می خواهید فیلد مورد نظر را حذف نماید؟");
            if (r == true) {
                document.forms["form-delete-users-" + id].submit();
            }
        }
    </script>
@endsection
