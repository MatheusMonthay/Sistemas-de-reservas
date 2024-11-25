@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="text-center mb-4">Lista de Reservas</h3>

    <!-- Botão para Nova Reserva -->
    <div class="text-end mb-4">
        <a href="{{ route('reservas.create') }}" class="btn btn-success">Nova Reserva</a>
    </div>

    <!-- Filtros -->
    <form method="GET" action="{{ route('reservas.index') }}" class="mb-4">
        <div class="row g-3">
            <div class="col-md-3">
                <label for="ambiente" class="form-label">Ambiente</label>
                <select id="ambiente" name="ambiente_id" class="form-select">
                    <option value="">Todos</option>
                    @foreach($ambientes as $ambiente)
                    <option value="{{ $ambiente->id }}" {{ request('ambiente_id') == $ambiente->id ? 'selected' : '' }}>
                        {{ $ambiente->nome }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="inicio_periodo" class="form-label">Início do Período</label>
                <input type="date" id="inicio_periodo" name="inicio_periodo" class="form-control"
                    value="{{ request('inicio_periodo') }}">
            </div>
            <div class="col-md-3">
                <label for="fim_periodo" class="form-label">Fim do Período</label>
                <input type="date" id="fim_periodo" name="fim_periodo" class="form-control"
                    value="{{ request('fim_periodo') }}">
            </div>
            <div class="col-md-3">
                <label for="professor" class="form-label">Professor</label>
                <select id="professor" name="professor" class="form-select">
                    <option value="">Todos</option>
                    @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}" {{ request('professor') == $usuario->id ? 'selected' : '' }}>
                        {{ $usuario->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="minhas_reservas" class="form-label">Minhas Reservas</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="minhas_reservas" name="minhas_reservas"
                        value="1" {{ request('minhas_reservas') ? 'checked' : '' }}>
                    <label class="form-check-label" for="minhas_reservas">Exibir somente minhas reservas</label>
                </div>
            </div>
        </div>
        <div class="text-end mt-3">
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a href="{{ route('reservas.index') }}" class="btn btn-secondary">Limpar Filtros</a>
        </div>
    </form>

    <!-- Mensagem de sucesso -->
    @if(session('sucesso'))
    <div class="alert alert-success">
        {{ session('sucesso') }}
    </div>
    @endif

    <!-- Tabela de reservas -->
    @if($reservas->isEmpty())
    <div class="alert alert-warning text-center">
        Nenhuma reserva encontrada.
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
                <td>{{ $reserva->user->name }}</td>
                <td>{{ \Carbon\Carbon::parse($reserva->inicio)->format('d/m/Y H:i') }}</td>
                <td>{{ \Carbon\Carbon::parse($reserva->fim)->format('d/m/Y H:i') }}</td>
                <td>
                    @if($reserva->equipamentos->isEmpty())
                    Nenhum
                    @else
                    {{ $reserva->equipamentos->pluck('nome')->join(', ') }}
                    @endif
                </td>
                <td>{{ $reserva->ocorrencia ?? 'Nenhuma' }}</td>
                <td>
                    @if(auth()->user()->role === 'admin' || auth()->user()->id === $reserva->user_id)
                    <a href="{{ route('reservas.edit', $reserva->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('reservas.destroy', $reserva->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Tem certeza que deseja excluir esta reserva?')">Excluir</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection