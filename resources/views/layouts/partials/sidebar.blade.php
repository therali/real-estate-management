<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image"/>
                </div>
                <div class="pull-left info">
                    <p style="overflow: hidden;text-overflow: ellipsis;max-width: 160px;" data-toggle="tooltip"
                       title="{{ Auth::user()->name }}">{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('message.online') }}</a>
                </div>
            </div>
    @endif
    <!-- Sidebar Menu -->
    {!! dynamicMenu() !!}
    <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
