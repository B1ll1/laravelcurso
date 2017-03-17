<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
      @if(Auth::user()->user_role_id!=3)
        <li class="treeview {{strpos(Request::url(), ' ') ? 'active' : ''}}">
          <a href="#">
            <i class="fa fa-users fa-fw"></i> <span>Usuários</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu {{strpos(Request::url(), ' ') ? 'menu-open' : ''}}">
            @if(Auth::user()->user_role_id==1)
            <li><a href="{{route('user.index')}}"><i class="fa ion-ios-circle-outline fa-fw text-red"></i>Todos</a></li>
            @elseif(Auth::user()->user_role_id==2)
            <li><a href="{{route('user.index')}}"><i class="fa ion-ios-circle-outline fa-fw text-red"></i>Meus Usuários</a></li>
            @endif
          </ul>
        </li>
        @endif

        <li class="treeview {{strpos(Request::url(), 'plataformas') ? 'active' : ''}}">
          <a href="#">
            <i class="fa fa-building fa-fw"></i> <span>Plataformas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{strpos(Request::url(), '/todas') ? 'active' : ''}}">
              <a href="{{ route('platform.index') }}">
                <i class="fa ion-ios-circle-{{strpos(Request::url(), '/todas') ? 'filled' : 'outline'}} fa-fw text-red"></i>Todas
              </a>
            </li>
            <li class="{{strpos(Request::url(), '/criar') ? 'active' : ''}}">
              <a href="{{ route('platform.create') }}">
                <i class="fa ion-ios-circle-{{strpos(Request::url(), '/criar') ? 'filled' : 'outline'}} fa-fw text-red"></i>Nova Plataforma
              </a>
            </li>
          </ul>
        </li>

        <li class="treeview {{strpos(Request::url(), 'categorias') ? 'active' : ''}}">
          <a href="#">
          <i class="fa ion-ios-pricetags fa-fw"></i> <span>Categorias</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left fa-fw pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu">
            @foreach($categories as $category)
            <li>
              <a href="">
                <i class="fa fa ion-ios-circle-{{strpos(Request::url(), '/'.$category->name) ? 'filled' : 'outline'}} fa-fw text-red"></i>
                <span>{{ $category->name }}</span>
              </a>
            </li>
            @endforeach
          </ul>
        </li>

        @if(Auth::check())
        <li class="{{ strpos(Request::url(), 'meus') ? 'active' : '' }}">
          <a href="">
            <i class="fa ion-android-cart fa-fw"></i> <span>Meus Pedidos</span>
          </a>
        </li>
        <li class="{{ strpos(Request::url(), 'vendas') ? 'active' : '' }}"">
          <a href="">
            <i class="fa ion-ios-list fa-fw"></i> <span>Minhas Vendas</span>
          </a>
        </li>
        @endif
    </section>
    <!-- /.sidebar -->
  </aside>