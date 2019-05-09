@extends('layouts.pages')
@section('title'){{'ظرفیت'}}@endsection
@section('content')
    <!-- Page Header -->
    <header class="page-header">
        <div class="content">
            <div class="title">
                <h1> ظرفیت </h1>
                <h6 class="desc">ظرفیت </h6></div>
            <div class="functions">
                <div class="field icon sm">
                    <input type="text" data-table="table" class="search" placeholder="جستجو...">
                    <a href="#" class="icon-search"></a>
                </div>
                <button onclick="location.href='{{url('products')}}';" class="white labeled"><span
                            class="icon-arrow-right"></span> بازگشت
                </button>
                <button onclick="location.href='{{url('products/'.$product_id.'/episode/create')}}';"
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
                        <th>تاریخ شروع</th>
                        {{--<th>تاریخ پایان</th>--}}
                        {{--<th>عرضه کننده</th>--}}
                        <th>ظرفیت</th>
                        @if($productInfo->time_limitation)
                            <th>ساعت شروع</th>
                            <th>ساعت پایان</th>
                        @endif
                        <th>وضعیت</th>
                        <th>تاریخ ثبت</th>
                        <th class="list-icon-button"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($productEpisodeInfo as $key=>$value)
                        <tr>
                            <td class="tac"><a href="#">{{$key+1}}</a></td>
                            <td class="column-time">{{jDate::forge(date('Y/m/d', $value->start_date))->format('%d %B %Y')}}</td>
                            {{--<td class="column-time">{{jDate::forge(date('Y/m/d', $value->end_date))->format('%d %B %Y')}}</td>--}}
                            {{--<td>{{$value->name}}</td>--}}
                            <td>
                                <?php $countFactorEpisode = \App\FactorDetails::where('product_episode_id', $value->id)->count();?>
                                {{intval($value->capacity-$countFactorEpisode)}}
                            </td>
                            @if($productInfo->time_limitation)
                                <td>{{$value->start_hours}}</td>
                                <td>{{$value->end_hours}}</td>
                            @endif
                            <td>
                                @if($value->status)
                                    {{'فعال'}}
                                @else
                                    {{'غیر فعال'}}
                                @endif
                            </td>
                            <td class="column-time">{{jDate::forge(date('Y/m/d', $value->created_at->timestamp))->format('%d %B %Y')}}</td>
                            <td class="td-button" style="width: 100px;">
                                <a href="{{url('products/'.$product_id.'/episode/'.$value->id.'/edit')}}"
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
                @if($productEpisodeInfo->hasPages())
                    <?php echo $productEpisodeInfo->render();?>
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
                document.forms["form-delete-episode-" + id].submit();
            }
        }
    </script>
@endsection