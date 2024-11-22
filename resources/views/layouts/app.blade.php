<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Sistema de Reservas de Salas' }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
    body {
        background-color: #f8f9fa;
    }

    .content-wrapper {
        min-height: 80vh;
        padding: 20px;
    }

    footer {
        background-color: #003366;
        color: white;
        text-align: center;
        padding: 10px 0;
        margin-top: 20px;
    }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#cpf').mask('000.000.000-00');
    });
    </script>
</head>

<body>
    @include('layouts.navbar')

    <div class="container content-wrapper">
        @yield('content')
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} Sistema de Reservas de Salas - Desenvolvido pelos alunos Jefferson, Leonardo, Marcos,
            Matheus e Wilianes</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>