@extends('layouts.pages')
@section('title'){{'دسته بندی آژانس'}}@endsection
@section('content')
    <!-- Page Header -->
    <header class="page-header">
        <div class="content">
            <div class="title">
                <h1> دسته بندی آژانس </h1>
                <h6 class="desc">دسته بندی آژانس </h6></div>
            <div class="functions">
                <div class="field icon sm">
                    <input type="text" data-table="table" class="search" placeholder="جستجو...">
                    <a href="#" class="icon-search"></a>
                </div>
                <button onclick="location.href='{{url('categoryAgency/create')}}';"
                        class="green labeled"><span
                        class="icon-plus"></span> افزودن
                </button>
            </div>
        </div>
        <ul class="header-tabs">
            <li @if($active=='all')class="active"@endif><a href="{{url('categoryAgency')}}"> همه
                </a></li>
            <li @if($active==1)class="active"@endif><a href="{{url('categoryAgency/1')}}"> فعال
                </a></li>
            <li @if($active=='false')class="active"@endif><a href="{{url('categoryAgency/0')}}"> غیر فعال
                </a></li>
            <li @if($active==-1)class="active"@endif><a href="{{url('categoryAgency/-1')}}"><span
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
                        <th>درصد</th>
                        <th>وضعیت</th>
                        <th>تاریخ ثبت</th>
                        <th class="list-icon-button"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categoryAgencyInfo as $key=>$value)
                        <tr>
                            <td class="tac"><a href="#">{{$key+1}}</a></td>
                            <td>{{$value->title}}</td>
                            <td>{{$value->percent}}</td>
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
                            <td class="td-button" style="min-width: 100px;">
                                <a href="{{url('categoryAgency/'.$value->id.'/edit')}}"
                                   class="button green icon-pencil"></a>
                                <a id="{{$value->id}}" onclick="deleteFunction(this.id);"
                                   class="button red icon-trash"></a>
                                <form id="form-delete-categoryAgency-{{$value->id}}"
                                      action="{{url('categoryAgency/'.$value->id)}}" method="post">
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
                @if($categoryAgencyInfo->hasPages())
                    <?php echo $categoryAgencyInfo->render();?>
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
                document.forms["form-delete-categoryAgency-" + id].submit();
            }
        }
    </script>
@endsection
