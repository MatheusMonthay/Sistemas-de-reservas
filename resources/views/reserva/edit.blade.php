@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="text-center">Editar Reserva</h3>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('reservas.update', $reserva->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="ambiente_id" class="form-label">Ambiente</label>
            <select id="ambiente_id" name="ambiente_id" class="form-control" required>
                @foreach($ambientes as $ambiente)
                <option value="{{ $ambiente->id }}" @if($reserva->ambiente_id == $ambiente->id) selected @endif>
                    {{ $ambiente->nome }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="inicio" class="form-label">Início</label>
            <input type="datetime-local" id="inicio" name="inicio" class="form-control"
                value="{{ \Carbon\Carbon::parse($reserva->inicio)->format('Y-m-d\TH:i') }}" required>
        </div>

        <div class="mb-3">
            <label for="fim" class="form-label">Fim</label>
            <input type="datetime-local" id="fim" name="fim" class="form-control"
                value="{{ \Carbon\Carbon::parse($reserva->fim)->format('Y-m-d\TH:i') }}" required>
        </div>

        <div class="mb-3">
            <label for="ocorrencia" class="form-label">Observação (Opcional)</label>
            <textarea id="ocorrencia" name="ocorrencia" class="form-control"
                rows="3">{{ old('ocorrencia', $reserva->ocorrencia) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="equipamentos" class="form-label">Equipamentos</label>
            <select id="equipamentos" name="equipamentos[]" class="form-control" multiple>
                @foreach($equipamentos as $equipamento)
                <option value="{{ $equipamento->id }}" @if($reserva->
                    equipamentos->pluck('id')->contains($equipamento->id)) selected @endif>
                    {{ $equipamento->nome }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href="{{ route('reservas.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection