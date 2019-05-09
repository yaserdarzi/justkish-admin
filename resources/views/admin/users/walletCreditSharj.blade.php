@extends('layouts.pages')
@section('title')
    {{'افزایش کیف پول'}}
@endsection
@section('content')
    <div class="slider movie-items" style="padding-top: 10px;">
        <div class="container">
            <form method="POST" action="{{url('userWalletCreditSharj')}}"  >
                {!! csrf_field() !!}
                <header class="page-header">
                    <div class="content">
                        <div class="title">
                            <h1> افزودن کیف پول </h1>
                        </div>
                        <div class="functions">
                            <button class="purple"> افزایش</button>
                        </div>
                    </div>
                </header>
                <div class="main-content">
                    <div class="row">
                        @if(Session::get('success')!=null)
                            <div class="alert alt green">
                                <p>{{Session::get('success')}}</p>
                                <a href="#" class="icon-close alert-close "></a>
                            </div>
                        @endif
                        @if($errors->any())
                            <div class="alert alt red">
                                <p>{{$errors->first()}}</p>
                                <a href="#" class="icon-close alert-close "></a>
                            </div>
                        @endif
                        <div class="col-sm-12">
                            <!-- Form General -->
                            <section class="panel form-general">
                                <article>
                                    <ul class="tabs-contents">
                                        <li id="tab-lang-fa">

                                            @if(isset($packageWalletSharj))
                                                @foreach($packageWalletSharj as $value)
                                                    <label for="price{{$value->id}}"
                                                           style="height: 12px !important;display: inline-block !important; margin-right: 10px;">
                                                        <input style="width: 20px !important;display: inherit;position: relative;top: 14px; "
                                                               value="{{$value->price-$value->percent}}" type="radio" id="price{{$value->id}}" name="price">
                                                        <span style="color:#0D0A0A;">
                                                            {{$value->title}},
                                                            مبلغ کل{{number_format($value->price)}},
                                                            تخفیف{{number_format($value->percent)}},
                                                            مبلغ افزایش{{number_format($value->price-$value->percent)}}
                                                        </span>
                                                    </label>
                                                @endforeach
                                            @endif

                                        </li>
                                    </ul>
                                </article>
                            </section>
                        </div>
                    </div>
                </div>
            </form>
            <div dir="rtl">
                @if(sizeof($invoiceUsersWalletCreditInfo)!=0)
                    <h6 style="color: #858384; margin-top: 20px; margin-bottom: 10px;">همه سفارش ها</h6>
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%"
                           style="text-align: right;">
                        <thead>
                        <tr>
                            <th style="text-align:right;">#</th>
                            <th style="text-align:right;">شماره پیگیری</th>
                            <th style="text-align:right;">تاریخ خرید</th>
                            <th style="text-align:right;">مبلغ</th>
                            <th style="text-align:right;">اعتبار</th>
                            <th style="text-align:right;">نوع</th>
                            <th style="text-align:right;">افزایش / کاهش</th>
                            <th style="text-align:right;">وضیعت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoiceUsersWalletCreditInfo as $key=> $value)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$value->payment_token}}</td>
                                <td>{{jDate::forge(date('Y/m/d', $value->created_at->timestamp))->format('%d %B %Y')}}</td>
                                <td>{{number_format($value->wallet_price)}}</td>
                                <td>{{number_format($value->credit_price)}}</td>
                                <td>
                                    @if($value->status_wc_price==\App\Inside\Constants::INVOICE_WALLET_CREDIT_STATUS_WC_PRICE_WALLET)
                                        {{"کیف پول"}}
                                    @else
                                        {{"اعتبار"}}
                                    @endif
                                </td>
                                <td>
                                    @if($value->type_price==\App\Inside\Constants::INVOICE_WALLET_CREDIT_TYPE_PRICE_INCREASES)
                                        {{"افزایش"}}
                                    @else
                                        {{"کاهش"}}
                                    @endif
                                </td>
                                <td>
                                    @if($value->status==\App\Inside\Constants::INVOICE_WALLET_CREDIT_STATUS_SUCCESS)
                                        {{'تراکنش موفق'}}
                                    @elseif($value->status==\App\Inside\Constants::INVOICE_WALLET_CREDIT_STATUS_FAILED)
                                        {{'تراکنش ناموفق'}}
                                    @elseif($value->status==\App\Inside\Constants::INVOICE_WALLET_CREDIT_STATUS_PENDING)
                                        {{'در حال بررسی'}}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
                <div class="paginate tal">
                    <ul class="pagination">
                        @if($invoiceUsersWalletCreditInfo->hasPages())
                            <?php echo $invoiceUsersWalletCreditInfo->render();?>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <style>
        .btn-empty-shop {
            background-color: #3DB1FF;
            border-radius: 7px;
            border: none;
            color: #FFFFFF;
            padding: 15px 32px;
            width: 400px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 15px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .table thead th {
            border-bottom: 2px solid #3DB1FF;
            background-color: #3DB1FF;
        }

        .table-bordered th, .table-bordered td {
            border: none;
        }
    </style>
@endsection

