<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Reservas de Salas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
    body {
        background-color: #bcd0e5;
        /* Fundo azul claro */
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
    }

    .dashboard-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        text-align: center;
        padding: 20px;
        width: 600px;
    }

    .dashboard-logo img {
        width: 80px;
        margin-bottom: 15px;
    }

    .dashboard-title {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 5px;
        color: #003366;
        /* Azul escuro */
    }

    .dashboard-subtitle {
        font-size: 0.9rem;
        color: gray;
        margin-bottom: 20px;
    }

    .greeting {
        font-size: 1rem;
        margin-bottom: 15px;
        color: #003366;
        /* Azul escuro */
    }

    .btn-custom {
        background-color: #003366;
        /* Azul escuro */
        color: white;
        border: none;
        padding: 10px 20px;
        margin: 10px 0;
        width: 100%;
        font-size: 1rem;
        font-weight: bold;
    }

    .btn-custom:hover {
        background-color: #002244;
        /* Azul mais escuro */
    }

    .btn-logout {
        background-color: #ff5252;
        color: white;
        margin-top: 15px;
    }

    .btn-logout:hover {
        background-color: #e04747;
    }
    </style>
</head>

<body>
    <div class="dashboard-card">
        <div class="dashboard-logo">
            <img src="images/logouninassau.png" alt="Logo">
        </div>
        <h1 class="dashboard-title">Sistema de Reservas de Salas</h1>
        <p class="greeting">
            Olá, <b>{{ Auth::user()->name }}</b>!
        </p>
        <p class="dashboard-subtitle">Selecione uma opção abaixo</p>
        <a href="{{ route('reservas.index') }}" class="btn btn-custom">Reservas</a>
        <a href="{{ route('ocorrencias.index') }}" class="btn btn-custom">Ocorrências</a>

        @if(auth()->user()->role === 'admin')
        <a href="{{ route('admin.index') }}" class="btn btn-custom">Painel do Administrador</a>
        @endif <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
            @csrf
            <button type="submit" class="btn btn-logout">Logout</button>
        </form>
    </div>
</body>

</html>