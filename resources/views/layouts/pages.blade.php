<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0"/>
    <link rel="stylesheet" href="{{asset('files/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/dist/css/select2.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('css')
</head>


<body>
<!-- Top Bar -->
<header id="top-bar">
    <!-- Site Logo -->
    <a href="#" id="site-logo">
        <h1> ادمین </h1></a>

{{--<a style="color: #0D0A0A; position: relative; top: 20px; right: 5px;">موجودی کیف پول :<span>{{number_format($walletUserInfo->wallet_price)}}</span></a>--}}
{{--<a style="color: #0D0A0A; position: relative; top: 20px; right: 20px;">موجودی اعتبار :<span>{{number_format($walletUserInfo->credit_price)}}</span></a>--}}
{{--<a class="button green" style="position: relative; top: 20px; right: 20px;" href="{{url('userWalletCreditSharj')}}">افزودن کیف پول</a>--}}

<!-- Right Functions -->

    <!-- Left Functions -->
    <div class="left-functions">
        <div class="dropdown user-dropdown bottom-left">
            <a class="user dropdown-toggle" href="#"> <span class="avatar"></span>
                <h6> کاربری </h6></a>
            <div class="menu">
                <a href="{{url('auth/logout')}}"><span class="icon-logout"></span> خروج </a></div>
        </div>
    </div>
</header>

<!-- Sidebar -->
@include('sidebar')

<!-- Wrapper -->
<div class="wrapper">


    @yield('content')
</div>

<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/jquery-ui.js')}}"></script>
@yield('footer')
<script src="{{asset('js/fullscreen.js')}}"></script>
<script src="{{asset('js/tagging.js')}}"></script>
<script src="{{asset('js/uploadPreview.js')}}"></script>
<script src="{{asset('js/editable.js')}}"></script>
<script src="{{asset('js/nestedSortable.js')}}"></script>
<script src="{{asset('js/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('ckeditor5/ckeditor.js')}}"></script>
@yield('script')
<script>
    let allEditors = document.querySelectorAll('textarea');
    for (var i = 0; i < allEditors.length; ++i) {
        ClassicEditor
            .create(document.querySelector("#" + allEditors[i].id), {
                // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(err => {
                console.error(err.stack);
            });
    }
</script>
<script>
    (function (document) {
        'use strict';
        var LightTableFilter = (function (Arr) {
            var _input;

            function _onInputEvent(e) {
                _input = e.target;
                var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
                Arr.forEach.call(tables, function (table) {
                    Arr.forEach.call(table.tBodies, function (tbody) {
                        Arr.forEach.call(tbody.rows, _filter);
                    });
                });
            }

            function _filter(row) {
                var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
                row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
            }

            return {
                init: function () {
                    var inputs = document.getElementsByClassName('search');
                    Arr.forEach.call(inputs, function (input) {
                        input.oninput = _onInputEvent;
                    });
                }
            };
        })(Array.prototype);
        document.addEventListener('readystatechange', function () {
            if (document.readyState === 'complete') {
                LightTableFilter.init();
            }
        });
    })(document);
</script>
<!-- Load Scripts -->
<script type="text/javascript">
    /* ONLY NUMBER */
    function onlynumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }

    /* END ONLY NUMBER */

    /* NUMBER DIGIT */
    function Number_Three_digit(Num) {
        Num += '';
        Num = Num.replace(/,/g, '');
        x = Num.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1))
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        return x1 + x2;
    }

    /* END NUMBER DIGIT */
</script>
<script>
    //tinymce.init({forced_root_block : "",selector:'textarea'});
    $('.icon-close').on('click', function (e) {
        e.preventDefault();
        $('body').removeClass('modal-open');
        $('.modal').removeClass('open');
        $('.modal-bg').removeClass('open');
        $('.modal-bg').remove();
        $('.overlay').removeClass('open');
    });
</script>
</body>
</html>
