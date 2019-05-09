@extends('layouts.pages')
@section('title'){{'پلن'}}@endsection
@section('content')
    <!-- Page Header -->
    <header class="page-header">
        <div class="content">
            <div class="title">
                <h1> پلن </h1>
                <h6 class="desc">پلن </h6></div>
            <div class="functions">
                <div class="field icon sm">
                    <input type="text" data-table="table" class="search" placeholder="جستجو...">
                    <a href="#" class="icon-search"></a>
                </div>
                <button onclick="location.href='{{url('category')}}';" class="white labeled"><span
                            class="icon-arrow-right"></span> بازگشت
                </button>
                <button onclick="location.href='{{url('category/'.$category_id.'/plan/create')}}';"
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
                        <th>نام پلن</th>
                        <th>قیمت</th>
                        <th>کمترین</th>
                        <th>بیشترین</th>
                        <th>ترتیب نمایش</th>
                        <th>تاریخ ثبت</th>
                        <th class="list-icon-button"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categoryPlanInfo as $key=>$value)
                        <tr>
                            <td class="tac"><a href="#">{{$key+1}}</a></td>
                            <td>{{$value->title}}</td>
                            <td>{{number_format($value->price)}}</td>
                            <td>{{$value->min}}</td>
                            <td>{{$value->max}}</td>
                            <td>{{$value->sort}}</td>
                            <td class="column-time">{{jDate::forge(date('Y/m/d', $value->created_at->timestamp))->format('%d %B %Y')}}</td>
                            <td class="td-button" style="width: 100px;">
                                <a href="{{url('category/'.$category_id.'/plan/'.$value->id.'/edit')}}"
                                   class="button green icon-pencil"></a>
                                <a id="{{$value->id}}" onclick="deleteFunction(this.id);"
                                   class="button red icon-trash"></a>
                                <form id="form-delete-plan-{{$value->id}}"
                                      action="{{url('category/'.$category_id.'/plan/'.$value->id)}}" method="post">
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
                @if($categoryPlanInfo->hasPages())
                    <?php echo $categoryPlanInfo->render();?>
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
                document.forms["form-delete-plan-" + id].submit();
            }
        }
    </script>
@endsection