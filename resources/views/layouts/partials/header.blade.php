<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>L</b>I</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Laravel </b>Importação</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <li>
            <a href="">Vender</a>
          </li>

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
          @if(Auth::check())
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="" class="user-image" alt="User Image">
              <span class="hidden-xs"></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="" class="img-circle" alt="User Image">
                <!--
                <p>
                  {{ ucfirst(Auth::user()->name) }}
                  <small>Membro desde {{ Auth::user()->created_at->format('M. Y') }}</small>
                </p>
                -->
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Pedidos</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Anúncios</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="" class="btn btn-success btn-flat">Meus Dados</a>
                </div>
                <div class="pull-right">
                  <a href="{{ url('/logout') }}" class="btn btn-danger btn-flat"><i class="fa fa-sign-out"></i> Sair</a>
                </div>
              </li>
            </ul>
            @else
            <a href="">Login</a>
            @endif
          </li>

        </ul>
      </div>
    </nav>
  </header>