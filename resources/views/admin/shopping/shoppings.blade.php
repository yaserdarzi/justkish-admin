@extends('layouts.pages')
@section('footer')
    <script src="{{asset('js/shopping.js')}}"></script>
@endsection
@section('content')
    <!-- Page Header -->
    <header class="page-header">
        <div class="content">
            <div class="title">
                <h1> سفارشات </h1>

            </div>

        </div>
    </header>
    <!-- START: Main Content -->
    <div class="main-content">
        @if($invoice->items())
            <section class="panel">
                <article class="p0">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>نام مشتری</th>
                            <th>کد پیگیری</th>
                            <th>مبلغ کل</th>
                            <th>جزییات سفارش</th>
                            <th>وضعیت پرداخت</th>
                            <th>وضعیت سفارش</th>
                            <th>ویرابیش وضعیت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoice as $list)
                            <tr>
                                <td>{{$list->name}}</td>
                                <td>{{$list->payment_token}}</td>
                                <td>{{$list->price_all}}</td>
                                <td>
                                    <a href="{{ route('dashboard.shoppingDetails', [$list->invoice_id]).'?payment_token='.$list->payment_token }}"
                                       class="button teal icon-eye"></a></td>
                                <td>
                                    @if($list->status_invoice==1)
                                        {{'پرداخت شده'}}
                                    @elseif($list->status_invoice==-1 ||$list->status_invoice==0)
                                        {{'تراکنش ناموفق'}}
                                    @endif
                                </td>
                                <td>
                                    @if($list->shopping_status==0)
                                        {{'درحال بررسی'}}
                                    @elseif($list->shopping_status==1)
                                        {{'تحویل به پیک'}}
                                    @elseif($list->shopping_status==2)
                                        {{'تحویل به مشتری'}}
                                    @endif
                                </td>
                                <td>
                                    <div class="lang-edit">
                                        <a class="icon-pencil edit button purple" data-modal="#edit"
                                           id="{{$list->invoice_id}}"></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </article>
            </section>
            <div class="paginate tal">
                <ul class="pagination">
                    @if($invoice->hasPages())
                        <?php echo $invoice->render(); ?>
                    @endif
                </ul>
            </div>
        @else

            <div class="panel no-result">
                <article>
                    <span class="icon-file"></span>
                    <h4>هنوز درخواستی در سیستم ثبت نشده است. </h4>
                </article>
            </div>
        @endif
    </div>
    <!-- END: Main Content -->
    @include('admin.shopping.shoppingStatusEdit')
    {{--@include('movieRemove')--}}
@endsection