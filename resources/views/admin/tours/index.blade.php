@extends('layouts.pages')
@section('title'){{' تور و پکیج '}}@endsection
@section('content')
    <!-- Page Header -->
    <header class="page-header">
        <div class="content">
            <div class="title">
                <h1> تور و پکیج </h1>
                <h6 class="desc">تور و پکیج </h6></div>
            <div class="functions">
                <div class="field icon sm">
                    <input type="text" data-table="table" class="search" placeholder="جستجو...">
                    <a href="#" class="icon-search"></a>
                </div>
                @if($role=="admin")
                    <button onclick="location.href='{{url('tours/create')}}';" class="green labeled"><span
                                class="icon-plus"></span> افزودن
                    </button>
                @endif
            </div>
        </div>
        <ul class="header-tabs">
            <li @if($active=='all')class="active"@endif><a href="{{url('tours')}}"> همه
                </a></li>
            <li @if($active==1)class="active"@endif><a href="{{url('tours/1')}}"> فعال
                </a></li>
            <li @if($active=='false')class="active"@endif><a href="{{url('tours/0')}}"> غیر فعال
                </a></li>
            <li @if($active==-1)class="active"@endif><a href="{{url('tours/-1')}}"><span
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
                        <th>عنوان</th>
                        <th>داری محدودیت زمانی</th>
                        <th>تصویر</th>
                        <th>وضعیت</th>
                        <th>تاریخ ثبت</th>
                        <th class="list-icon-button"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($toursInfo as $key=>$value)
                        <tr>
                            <td class="tac"><a href="#">{{$key+1}}</a></td>
                            <td>{{$value->title}}</td>
                            <td>
                                @if($value->time_limitation)
                                    {{"دارد"}}
                                @else
                                    {{"ندارد"}}
                                @endif
                            </td>
                            <td>
                                @if($value->images!=null)
                                    <img style="width: 50px; height: 50px;"
                                         src="{{asset('files/tours'.'/'.$value->images)}}"/>
                                @endif
                            </td>
                            <td>
                                @if($value->status==0)
                                    {{'غیر فعال'}}
                                @elseif($value->status==1)
                                    {{'فعال'}}
                                @elseif($value->status==-1)
                                    {{'حذف شده'}}
                                @endif
                            </td>
                            <td class="column-time">{{jDate::forge(date('Y/m/d', (integer)$value->created_at->timestamp))->format('%d %B %Y')}}</td>
                            <td class="td-button" style="min-width: 240px;">
                                @if($role=="admin")
                                    <a href="{{url('tours/'.$value->id.'/priceAgeRange')}}"
                                       class="button blue icon-dollar"></a>
                                    <a href="{{url('tours/'.$value->id.'/supplier')}}"
                                       class="button blue icon-user"></a>
                                @endif
                                @if($role!="admin")
                                    <a href="{{url('tours/'.$value->id.'/episode')}}"
                                       class="button blue icon-ticket"></a>
                                @endif
                                @if($role=="admin")
                                    <a href="{{url('tours/'.$value->id.'/edit')}}"
                                       class="button green icon-pencil"></a>
                                    <a id="{{$value->id}}" onclick="deleteFunction(this.id);"
                                       class="button red icon-trash"></a>
                                    <form id="form-delete-tours-{{$value->id}}"
                                          action="{{url('tours/'.$value->id)}}" method="post">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </article>
        </section>
        <div class="paginate tal">
            <ul class="pagination">
                @if($toursInfo->hasPages())
                    <?php echo $toursInfo->render();?>
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
                document.forms["form-delete-tours-" + id].submit();
            }
        }
    </script>
@endsection