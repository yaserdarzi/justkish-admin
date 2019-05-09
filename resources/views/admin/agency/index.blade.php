@extends('layouts.pages')
@section('title'){{' آژانس'}}@endsection
@section('content')
    <!-- Page Header -->
    <header class="page-header">
        <div class="content">
            <div class="title">
                <h1>  آژانس </h1>
                <h6 class="desc"> آژانس </h6></div>
            <div class="functions">
                <div class="field icon sm">
                    <input type="text" data-table="table" class="search" placeholder="جستجو...">
                    <a href="#" class="icon-search"></a>
                </div>
                <button onclick="location.href='{{url('agency/create')}}';"
                        class="green labeled"><span
                        class="icon-plus"></span> افزودن
                </button>
            </div>
        </div>
        <ul class="header-tabs">
            <li @if($active=='all')class="active"@endif><a href="{{url('agency')}}"> همه
                </a></li>
            <li @if($active==1)class="active"@endif><a href="{{url('agency/1')}}"> فعال
                </a></li>
            <li @if($active=='false')class="active"@endif><a href="{{url('agency/0')}}"> غیر فعال
                </a></li>
            <li @if($active==-1)class="active"@endif><a href="{{url('agency/-1')}}"><span
                        class="icon-trash"></span> سطل زباله
                </a></li>
        </ul>
    </header>
    <div class="main-content">
        <section class="panel">
            <article class="p0">
                <table class="table">
                    <thead>
                    <tr>
                        <th class="tac">#</th>
                        <th>نام</th>
                        <th>دسته بندی</th>
                        <th>نام کاربری</th>
                        <th>شماره همراه</th>
                        <th>شماره تماس</th>
                        <th>وضعیت</th>
                        <th>تاریخ ثبت</th>
                        <th class="list-icon-button"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($agencyInfo as $key=>$value)
                        <tr>
                            <td class="tac"><a href="#">{{$key+1}}</a></td>
                            <td>{{$value->name}}</td>
                            <td>{{$value->title}}</td>
                            <td>{{$value->username}}</td>
                            <td>{{$value->phone}}</td>
                            <td>{{$value->tell}}</td>
                            <td>
                                @if($value->status==0)
                                    {{'غیر فعال'}}
                                @elseif($value->status==1)
                                    {{'فعال'}}
                                @elseif($value->status==-1)
                                    {{'حذف شده'}}
                                @endif
                            </td>
                            <td class="column-time">{{jDate::forge(date('Y/m/d', (integer)$value->created_at))->format('%d %B %Y')}}</td>
                            <td class="td-button" style="min-width: 300px;">
                                <button onclick="location.href='{{url('agency/'.$value->id.'/wallet')}}';"
                                        class="blue labeled"><span
                                            class="icon-dollar"></span>کیف پول
                                </button>
                                <button onclick="location.href='{{url('agency/'.$value->id.'/credit')}}';"
                                        class="blue labeled"><span
                                            class="icon-dollar"></span> اعتبار
                                </button>
                                <a href="{{url('agency/'.$value->id.'/edit')}}"
                                   class="button green icon-pencil"></a>
                                <a id="{{$value->id}}" onclick="deleteFunction(this.id);"
                                   class="button red icon-trash"></a>
                                <form id="form-delete-agency-{{$value->id}}"
                                      action="{{url('agency/'.$value->id)}}" method="post">
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
        <div class="paginate tal">
            <ul class="pagination">
                @if($agencyInfo->hasPages())
                    <?php echo $agencyInfo->render();?>
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
                document.forms["form-delete-agency-" + id].submit();
            }
        }
    </script>
@endsection
