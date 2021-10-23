<h2 class="hidden">Navigation</h2>
<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel hide">
      <div class="pull-left image">
        <img src="{{ profile_image() }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{!! user()->firstname !!}</p>
        <p>{!! user()->lastname !!}</p>
      </div>
    </div>

    <nav>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">NAVIGATION</li>
        @include('admin.partials.navigation_list', ['collection' => $navigation['root']])
      </ul>
    </nav>
  </section>
</aside>








{{--<h2 class="hidden">Navigation</h2>--}}
{{--<div class="sidebar-menu">--}}
{{--  <div class="sidebar">--}}
{{--    <div class="user-panel ">--}}
{{--      <div class="pull-left image">--}}
{{--        <img src="{{ profile_image() }}" class="img-circle" alt="User Image">--}}
{{--      </div>--}}
{{--      <div class="pull-left info">--}}
{{--        <p>{!! user()->firstname !!}</p>--}}
{{--        <p>{!! user()->lastname !!}</p>--}}
{{--      </div>--}}
{{--    </div>--}}

{{--    <div class="menu-inner" >--}}
{{--      <nav>--}}
{{--        <ul class="metismenu" data-widget="tree">--}}
{{--          <li class="header">NAVIGATION</li>--}}
{{--          @include('admin.partials.navigation_list', ['collection' => $navigation['root']])--}}
{{--        </ul>--}}
{{--      </nav>--}}
{{--    </div>--}}


{{--  </div>--}}

{{--</div>--}}
