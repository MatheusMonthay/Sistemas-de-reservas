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

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="ambiente_id" class="form-label">Ambiente</label>
                <select id="ambiente_id" name="ambiente_id" class="form-select" required>
                    @foreach($ambientes as $ambiente)
                    <option value="{{ $ambiente->id }}">{{ $ambiente->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="inicio" class="form-label">Início</label>
                <input type="datetime-local" id="inicio" name="inicio" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label for="fim" class="form-label">Fim</label>
                <input type="datetime-local" id="fim" name="fim" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="ocorrencia" class="form-label">Observação (Opcional)</label>
            <textarea id="ocorrencia" name="ocorrencia" class="form-control" rows="3">{{ old('ocorrencia') }}</textarea>
        </div>

        <div id="equipamentos-container" class="mb-4">
            <label class="form-label">Equipamentos</label>
            <div class="equipamento-field d-flex align-items-center mb-2">
                <select name="equipamentos[]" class="form-select me-2" required>
                    <option value="">Selecione um equipamento</option>
                    @foreach($equipamentos as $equipamento)
                    <option value="{{ $equipamento->id }}">{{ $equipamento->nome }}</option>
                    @endforeach
                </select>
                <button type="button" class="btn btn-outline-success btn-sm" onclick="addEquipamento()">
                    <i class="bi bi-plus">+</i>
                </button>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100 mb-2">Salvar</button>
        <a href="{{ route('reservas.index') }}" class="btn btn-secondary w-100">Voltar</a>
    </form>
</div>

<script>
function addEquipamento() {
    const container = document.getElementById('equipamentos-container');
    const equipamentoField = container.querySelector('.equipamento-field');
    const newField = equipamentoField.cloneNode(true);

    newField.querySelector('select').selectedIndex = 0;

    const removeButton = document.createElement('button');
    removeButton.type = 'button';
    removeButton.classList.add('btn', 'btn-outline-danger', 'btn-sm', 'ms-2');
    removeButton.textContent = 'X';
    removeButton.onclick = function() {
        removeEquipamento(newField);
    };

    newField.appendChild(removeButton);

    container.appendChild(newField);
}

function removeEquipamento(field) {
    const container = document.getElementById('equipamentos-container');
    if (container.children.length > 1) {
        container.removeChild(field);
    } else {
        alert('Você deve manter pelo menos um campo de equipamento.');
    }
}
</script>
@endsection