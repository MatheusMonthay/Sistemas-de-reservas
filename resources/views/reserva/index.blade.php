@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="text-center">Lista de Reservas</h3>
    <div class="text-end mb-3">
        <a href="{{ route('reservas.create') }}" class="btn btn-primary">Nova Reserva</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if($reservas->isEmpty())
    <div class="alert alert-warning text-center">
        Nenhuma reserva cadastrada.
    </div>
    @else
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Ambiente</th>
                <th>Professor</th>
                <th>Início</th>
                <th>Fim</th>
                <th>Equipamentos</th>
                <th>Observações</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservas as $reserva)
            <tr>
                <td>{{ $reserva->ambiente->nome }}</td>
                <td>{{ $reserva->user->name }}</td> <!-- Acessando o nome do professor -->
                <td>{{ \Carbon\Carbon::parse($reserva->inicio)->format('d/m/Y H:i') }}</td>
                <td>{{ \Carbon\Carbon::parse($reserva->fim)->format('d/m/Y H:i') }}</td>
                <td>
                    @if($reserva->equipamentos->isEmpty())
                    Nenhum
                    @else
                    {{ $reserva->equipamentos->pluck('nome')->join(', ') }}
                    @endif
                </td>
                <td>{{ $reserva->ocorrencia ?? 'Nenhuma' }}</td> <!-- Exibindo as observações -->
                @if(auth()->user()->role === 'admin' || auth()->user()->id === $reserva->user_id)
                <td>
                    <a href="{{ route('reservas.edit', $reserva->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('reservas.destroy', $reserva->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Tem certeza que deseja excluir esta reserva?')">Excluir</button>
                    </form>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection