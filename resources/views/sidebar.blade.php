<div id="sidebar">
    <ul id="sidemenu">
        <li><span class="subtitle"> بخش اصلی </span></li>
        <li>
            <a href="{{url('/')}}"> <span class="icon-dashboard"></span>
                <h6> پیشخوان </h6></a>
        </li>
        @if(in_array("admin-manage",$roleInfo))
            <li>
                <a href="{{url('admin')}}"> <span class="icon-user"></span>
                    <h6>مدیریت کاربران ادمین</h6></a>
            </li>
        @endif
        @if(in_array("category-manage",$roleInfo))
            <li>
                <a href="{{url('category')}}"> <span class="icon-files-o"></span>
                    <h6>مدیریت گروه بندی</h6></a>
            </li>
        @endif
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
    </ul>
</div>
