<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background-color: #f2f2f2;
        font-family: Arial, sans-serif;
    }

    .login-container {
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        width: 400px;
    }

    .login-container img {
        width: 80px;
        margin-bottom: 20px;
    }

    .login-container h1 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .login-container input[type="email"],
    .login-container input[type="password"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border-radius: 5px;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    .login-container input[type="password"] {
        margin-bottom: 20px;
    }

    .login-container input[type="submit"] {
        background-color: #000;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
    }

    .login-container input[type="submit"]:hover {
        background-color: #333;
    }

    .login-container .reset-password {
        display: block;
        margin-top: 10px;
        font-size: 14px;
        color: #555;
    }

    .login-container .reset-password:hover {
        color: #000;
    }
    </style>

</head>

<body>
    <div class="login-container">
        <img src="{{ asset('images/logouninassau.png') }}" alt="Logo">
        <h1>Sistemas de Reservas Salas e Recursos </h1>

        @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="email" name="login" placeholder="E-mail ou CPF" value="{{ old('login') }}" required autofocus>
            <input type="password" name="password" placeholder="Senha" required>
            <input type="submit" value="Entrar">
        </form>
    </div>
</body>

</html>