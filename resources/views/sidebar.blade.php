<div id="sidebar">
    <ul id="sidemenu">
        <li><span class="subtitle"> بخش اصلی </span></li>
        <li>
            <a href="{{url('/')}}"> <span class="icon-dashboard"></span>
                <h6> پیشخوان </h6></a>
        </li>
        @if(in_array("roles-manage",$roleInfo))
            <li class="has-sub">
                <a href="#"> <span class="icon-files-o"></span>
                    <h6> دسترسی کاربران </h6></a>
                <ul class="sub-menu">
                    <li><a href="{{url('user/roles')}}"> مدیریت نقش ها </a></li>
                    <li><a href="{{url('user/permissions')}}"> مدیریت دسترسی ها </a></li>
                </ul>
            </li>
        @endif
        @if(in_array("features-manage",$roleInfo) || in_array("group-features-manage",$roleInfo))
            <li class="has-sub">
                <a href="#"> <span class="icon-files-o"></span>
                    <h6> ویژگی ها </h6></a>
                <ul class="sub-menu">
                    @if(in_array("group-features-manage",$roleInfo))
                        <li><a href="{{url('group_features')}}"> مدیریت دسته بندی ویژگی </a></li>
                    @endif
                    @if(in_array("features-manage",$roleInfo) )
                        <li><a href="{{url('features')}}"> مدیریت ویژگی </a></li>
                    @endif
                </ul>
            </li>
        @endif
        {{--@if(in_array("admin-manage",$roleInfo))--}}
        {{--<li>--}}
        {{--<a href="{{url('admin')}}"> <span class="icon-user"></span>--}}
        {{--<h6>مدیریت کاربران ادمین</h6></a>--}}
        {{--</li>--}}
        {{--@endif--}}
        @if(in_array("category-manage",$roleInfo) ||in_array("products-manage",$roleInfo))
            <li class="has-sub">
                <a href="#"> <span class="icon-files-o"></span>
                    <h6> محصولات و گروه بندی </h6></a>
                <ul class="sub-menu">
                    @if(in_array("category-manage",$roleInfo))
                        <li><a href="{{url('category')}}"> مدیریت گروه بندی </a></li>
                    @endif
                    @if(in_array("products-manage",$roleInfo))
                        <li><a href="{{url('products')}}"> مدیریت محصولات </a></li>
                    @endif
                    {{--@if(in_array("tours-manage",$roleInfo))--}}
                    {{--<li><a href="{{url('tours')}}"> مدیریت تور و پکیج </a></li>--}}
                    {{--@endif--}}
                </ul>
            </li>
        @endif

    </ul>
</div>
