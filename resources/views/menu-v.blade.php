<header class="header header-sticky mb-4">
    <div class="container-fluid">
      <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
        <svg class="icon icon-lg">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
        </svg>
      </button><a class="header-brand d-md-none" href="#">
        <svg width="118" height="46" alt="CoreUI Logo">
          <use xlink:href="{{ asset('brand/coreui.svg#full') }}"></use>
        </svg></a>
      <ul class="header-nav ms-3">
          <li class="nav-item dropdown">
            <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <div class="d-flex justify-center align-content-center align-items-center">
                <div class="px-1">
                    {{ Auth::user()->name }}
                </div>
                    <div class="avatar avatar-md">
                    <img class="avatar-img" src="{{ asset('img/avatars/2.jpg') }}" alt="user@email.com">
                </div>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-end pt-0">
            <div class="dropdown-header bg-light py-2">
              <div class="fw-semibold">Configuraciones</div>
            </div><a class="dropdown-item" href="#">
              <svg class="icon me-2">
                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
              </svg> Perfil</a><a class="dropdown-item" href="#">
              <svg class="icon me-2">
                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
              </svg> Configuraciones</a><a class="dropdown-item" href="#">

            <div class="dropdown-divider"></div><a class="dropdown-item" href="#">
                <a class="dropdown-item" href="{{ url('/cerrarsesion') }}">
              <svg class="icon me-2">
                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
              </svg> Cerrar sesion</a>
          </div>
        </li>
      </ul>
    </div>
    <div class="header-divider"></div>
    <div class="container-fluid">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2">
          <li class="breadcrumb-item">
            <!-- if breadcrumb is single--><span><a class="text-decoration-none text-black" href="/">Inicio</a></span>
          </li>
          <li class="breadcrumb-item active"><span>@yield('breadcrumb')</span></li>
        </ol>
      </nav>
    </div>
  </header>
