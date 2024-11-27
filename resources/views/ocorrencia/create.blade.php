@extends('layouts.app')
@section('content')
<div class="container">
    <h3 class="text-center mb-4">Reportar Ocorrência</h3>

    <form method="POST" action="{{ route('ocorrencias.store', $reserva->id) }}">
        @csrf
        <input type="hidden" name="reserva_id" value="{{ $reserva->id }}">

        <div class="mb-3">
            <label for="usuario" class="form-label">Usuário</label>
            <input type="text" id="usuario" class="form-control" value="{{ $reserva->user->name }}" readonly>
        </div>

        <div class="mb-3">
            <label for="ambiente" class="form-label">Ambiente</label>
            <input type="text" id="ambiente" class="form-control" value="{{ $reserva->ambiente->nome }}" readonly>
        </div>

        <div class="mb-3">
            <label for="inicio" class="form-label">Início</label>
            <input type="text" id="inicio" class="form-control" value="{{ $reserva->inicio->format('d/m/Y H:i') }}"
                readonly>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição da Ocorrência</label>
            <textarea id="descricao" name="descricao" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Registrar Ocorrência</button>
        <a href="{{ route('reservas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection