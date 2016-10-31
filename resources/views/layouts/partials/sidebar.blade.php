<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            @foreach(config('sidebar') as $permKey => $menus)
                @foreach($menus as $menu)
                    @if(isset($menu[2]))
                        <li class="treeview {{Request::is("admin/".$menu[0])?'active':''}}">
                            <a href="#"><span>{{$menu[1]}}</span><i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                                @foreach($menu[2] as $sub)
                                    <li {{Request::is("admin/".$sub[0]) ? 'class=active' : ""}}>
                                        <a href="{{url("admin/".$sub[0])}}">{{$sub[1]}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @elseif(isset($menu[1]))
                        <li {{Request::is("admin/".$menu[0]) ? 'class=active' : ""}}>
                            <a href="{{url("admin/".$menu[0])}}">{{$menu[1]}}</a>
                        </li>
                    @else
                        <li class="header">{{$menu[0]}}</li>
                    @endif
                @endforeach
            @endforeach
        </ul><!-- /.sidebar-menu -->

    </section>
    <!-- /.sidebar -->

</aside>
