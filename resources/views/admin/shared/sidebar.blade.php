<div class="col-md-3 left_col menu_fixed">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{route('admin.home')}}" class="site_title"><i class="fas fa-fish"></i>
                <span>{{ config('app.name') }}</span></a>
        </div>
        <!-- menu profile quick info -->
    @include('admin.shared.menuProfile')
    <!-- /menu profile quick info -->

        <br/>

        <div class="clearfix"></div>
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a href="{{ route('admin.home')}}"><i class="fas fa-home"></i> Home
                        </a>
                    </li>
                    <li><a href="{{ route('admin.usuarios.index')}}"><i class="fas fa-user-tie"></i> Usuarios
                                            </a>
                    </li>
                    <li><a href="{{ route('admin.protocolos.index')}}"><i class="fas fa-key"></i> Protocolos
                                                                </a>
                    </li>
                </ul>
            </div>


        </div>
    </div>
</div>
