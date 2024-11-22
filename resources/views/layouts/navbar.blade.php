<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <img src="{{ asset('images/logouninassau.png') }}" alt="Logo" width="50"
                class="d-inline-block align-text-top">
            Sistema de Reservas
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Link para Reservas -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('reservas.index') }}">Reservas</a>
                </li>
                <!-- Link para Ocorrências -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ocorrencias.index') }}">Ocorrências</a>
                </li>
                <!-- Painel Admin (somente para admin) -->
                @if(auth()->user() && auth()->user()->role === 'admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.index') }}">Painel Admin</a>
                </li>
                @endif
                <!-- Saudação e Logout -->
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Olá, {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item" type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>