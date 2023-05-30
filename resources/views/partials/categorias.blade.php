<nav class="navbar navbar-expand-md navbar-white bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="#">
            <div class="d-block d-md-none">
                <button class="navbar-toggler" style="outline: none" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon text-primary">Categorías <i class="fas fa-caret-down"></i></span>
                </button>
            </div>
        </a>
       
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav mx-auto">
                @foreach ($categorias as $categoria)
                    <li class="nav-item">
                        <a class="nav-link text-dark lead catnav text-uppercase" href="{{route('categoria.show',['categoria' => $categoria->id])}}">{{$categoria->nombre}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>