<nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/home">Inventario</a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
          
        <ul class="nav navbar-nav">
          <li class="active"><a href="/home">Panel</a></li>
          <li><a href="/productos">Productos</a></li>
          <li><a href="/ventas">Ventas</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right pull-right" style="margin-top: 11px">
            <li>
            @if (Route::has('login'))
                <div >
                @auth
                <!-- Authentication Links -->
                @guest
                @else            
                <a title="Cerrar sesión" href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    Salir <span class="fa fa-sign-out"></span>                        
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
                @endguest
                @else
                <!-- <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>-->
                @endauth
            @endif
            </li>
        </ul>

      </div><!--/.nav-collapse -->
    </div>
  </nav>
