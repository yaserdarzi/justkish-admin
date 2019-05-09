@extends('layouts.pages')
@section('title'){{'ویژگی'}}@endsection
@section('content')
    <!-- Page Header -->
    <header class="page-header">
        <div class="content">
            <div class="title">
                <h1> ویژگی </h1>
                <h6 class="desc">ویژگی </h6></div>
            <div class="functions">
                <div class="field icon sm">
                    <input type="text" data-table="table" class="search" placeholder="جستجو...">
                    <a href="#" class="icon-search"></a>
                </div>
                <button onclick="location.href='{{url('features/create')}}';" class="green labeled"><span
                            class="icon-plus"></span> افزودن
                </button>
            </div>
        </div>
        <ul class="header-tabs">
            <li @if($active=='all')class="active"@endif><a href="{{url('features')}}"> همه
                </a></li>
            <li @if($active==1)class="active"@endif><a href="{{url('features/1')}}"> فعال
                </a></li>
            <li @if($active=='false')class="active"@endif><a href="{{url('features/0')}}"> غیر فعال
                </a></li>
            <li @if($active==-1)class="active"@endif><a href="{{url('features/-1')}}"><span
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
                        <th>گروه</th>
                        <th>تصویر</th>
                        <th>توضیحات</th>
                        <th>وضعیت</th>
                        <th>تاریخ</th>
                        <th class="list-icon-button"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($featuresInfo as $key=>$value)
                        <tr>
                            <td class="tac"><a href="#">{{$key+1}}</a></td>
                            <td>{{$value->title}}</td>
                            <td>
                                <?php $groupFeaturesInfo = \App\GroupFeatures::where('id', $value->group_features_id)->first(); ?>
                                {{$groupFeaturesInfo->title}}
                            </td>
                            <td>{{$value->description}}</td>
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
                            <td class="td-button" style="width: 150px;">
                                <a href="{{url('features/'.$value->id.'/answers')}}"
                                   class="button white icon-plus"></a>
                                <a href="{{url('features/'.$value->id.'/edit')}}"
                                   class="button green icon-pencil"></a>
                                <a id="{{$value->id}}" onclick="deleteFunction(this.id);"
                                   class="button red icon-trash"></a>
                                <form id="form-delete-features-{{$value->id}}"
                                      action="{{url('features/'.$value->id)}}" method="post">
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
                @if($featuresInfo->hasPages())
                    <?php echo $featuresInfo->render();?>
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
                document.forms["form-delete-features-" + id].submit();
            }
        }
    </script>
@endsection