@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="text-center">Nova Reserva</h3>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('reservas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="ambiente_id" class="form-label">Ambiente</label>
            <select id="ambiente_id" name="ambiente_id" class="form-control" required>
                @foreach($ambientes as $ambiente)
                <option value="{{ $ambiente->id }}">{{ $ambiente->nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="inicio" class="form-label">Início</label>
            <input type="datetime-local" id="inicio" name="inicio" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="fim" class="form-label">Fim</label>
            <input type="datetime-local" id="fim" name="fim" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="ocorrencia" class="form-label">Observação (Opcional)</label>
            <textarea id="ocorrencia" name="ocorrencia" class="form-control" rows="3">{{ old('ocorrencia') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="equipamentos" class="form-label">Equipamentos</label>
            <select id="equipamentos" name="equipamentos[]" class="form-control" multiple>
                @foreach($equipamentos as $equipamento)
                <option value="{{ $equipamento->id }}">{{ $equipamento->nome }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('reservas.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection