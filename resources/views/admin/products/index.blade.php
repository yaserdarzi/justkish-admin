@extends('layouts.pages')
@section('title'){{'محصولات'}}@endsection
@section('content')
    <!-- Page Header -->
    <header class="page-header">
        <div class="content">
            <div class="title">
                <h1> محصولات </h1>
                <h6 class="desc">محصولات </h6></div>
            <div class="functions">
                <div class="field icon sm">
                    <input type="text" data-table="table" class="search" placeholder="جستجو...">
                    <a href="#" class="icon-search"></a>
                </div>
                <button onclick="location.href='{{url('products/create')}}';" class="green labeled"><span
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
                        <th>گروه بندی</th>
                        <th>داری محدودیت زمانی</th>
                        <th>تصویر</th>
                        <th>قیمت بزرگسال</th>
                        <th>ترتیب نمایش</th>
                        <th>تاریخ ثبت</th>
                        <th class="list-icon-button"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($productsInfo as $key=>$value)
                        <tr>
                            <td class="tac"><a href="#">{{$key+1}}</a></td>
                            <td>{{$value->title}}</td>
                            <td>{{$value->category->title}}</td>
                            <td>
                                @if($value->time_limitation)
                                    {{"دارد"}}
                                @else
                                    {{"ندارد"}}
                                @endif
                            </td>
                            <td>
                                @if($value->image!=null)
                                    <img style="width: 50px; height: 50px;"
                                         src="{{config('app.cdn_image_url').'/files/products/'.$value->image}}"/>
                                @endif
                            </td>
                            <td>{{number_format($value->price_adult)}}</td>
                            <td>{{$value->sort}}</td>
                            <td class="column-time">{{jDate::forge(date('Y/m/d', (integer)$value->created_at->timestamp))->format('%d %B %Y')}}</td>
                            <td class="td-button" style="min-width: 200px;">
                                <a href="{{url('products/'.$value->id.'/priceAgeRange')}}"
                                   class="button blue icon-dollar"></a>
                                <a href="{{url('products/'.$value->id.'/supplier')}}"
                                   class="button blue icon-user"></a>
                                <a href="{{url('products/'.$value->id.'/episode')}}"
                                   class="button blue icon-ticket"></a>
                                <a href="{{url('products/'.$value->id.'/edit')}}"
                                   class="button green icon-pencil"></a>
                                <a id="{{$value->id}}" onclick="deleteFunction(this.id);"
                                   class="button red icon-trash"></a>
                                <form id="form-delete-products-{{$value->id}}"
                                      action="{{url('products/'.$value->id)}}" method="post">
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
                @if($productsInfo->hasPages())
                    <?php echo $productsInfo->render();?>
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
                document.forms["form-delete-products-" + id].submit();
            }
        }
    </script>
@endsection