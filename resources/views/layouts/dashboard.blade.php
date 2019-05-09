<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <title>پیشخوان</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
    <link rel="stylesheet" href="{{asset('css/style.css')}}"> </head>


<body>
<!-- Top Bar -->
<header id="top-bar">
    <!-- Site Logo -->
    <a href="#" id="site-logo">
        <h1> ادمین </h1> </a>

    <!-- Left Functions -->
    <div class="left-functions">
        <div class="dropdown user-dropdown bottom-left">
            <a class="user dropdown-toggle" href="#"> <span class="avatar"></span>
                <h6> کاربری </h6> </a>
            <div class="menu"> <a href="/users/createUser"><span class="icon-user"></span>  ایجاد حساب کاربری </a>
                <div class="separator"></div> <a href="/auth/logout"><span class="icon-logout"></span> خروج </a> </div>
        </div>




    </div>
</header>
<!-- Sidebar -->
@include('sidebar')
    <!-- Wrapper -->
<div class="wrapper">



@yield('content')



</div>
<!-- End of Wrapper -->
<!-- Load Scripts -->
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/jquery-ui.js')}}"></script>
<script src="{{asset('js/fullscreen.js')}}"></script>
<script src="{{asset('js/tagging.js')}}"></script>
<script src="{{asset('js/uploadPreview.js')}}"></script>
<script src="{{asset('js/editable.js')}}"></script>
<script src="{{asset('js/nestedSortable.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
@yield('footer')
</body>

</html>

