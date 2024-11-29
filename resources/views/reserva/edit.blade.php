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

        <div class="mb-3 d-flex justify-content-between">
            <div class="me-2" style="flex: 1;">
                <label for="ambiente_id" class="form-label">Ambiente</label>
                <select id="ambiente_id" name="ambiente_id" class="form-control" required>
                    @foreach($ambientes as $ambiente)
                    <option value="{{ $ambiente->id }}" @if($reserva->ambiente_id == $ambiente->id) selected @endif>
                        {{ $ambiente->nome }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="me-2" style="flex: 1;">
                <label for="inicio" class="form-label">Início</label>
                <input type="datetime-local" id="inicio" name="inicio" class="form-control"
                    value="{{ \Carbon\Carbon::parse($reserva->inicio)->format('Y-m-d\TH:i') }}" required>
            </div>
            <div style="flex: 1;">
                <label for="fim" class="form-label">Fim</label>
                <input type="datetime-local" id="fim" name="fim" class="form-control"
                    value="{{ \Carbon\Carbon::parse($reserva->fim)->format('Y-m-d\TH:i') }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="ocorrencia" class="form-label">Observação (Opcional)</label>
            <textarea id="ocorrencia" name="ocorrencia" class="form-control"
                rows="3">{{ old('ocorrencia', $reserva->ocorrencia) }}</textarea>
        </div>

        <div id="equipamentos-container" class="mb-4">
            <label class="form-label">Equipamentos</label>
            @foreach($reserva->equipamentos as $equipamentoSelecionado)
            <div class="equipamento-field d-flex align-items-center mb-2">
                <select name="equipamentos[]" class="form-select me-2" required>
                    <option value="">Selecione um equipamento</option>
                    @foreach($equipamentos as $equipamento)
                    <option value="{{ $equipamento->id }}" @if($equipamentoSelecionado->id == $equipamento->id) selected
                        @endif>
                        {{ $equipamento->nome }}
                    </option>
                    @endforeach
                </select>
                <button type="button" class="btn btn-outline-danger btn-sm ms-2"
                    onclick="removeEquipamento(this)">X</button>
            </div>
            @endforeach

            <!-- Campo para adicionar novos equipamentos -->
            <div class="equipamento-field d-flex align-items-center mb-2">
                <select name="equipamentos[]" class="form-select me-2" required>
                    <option value="">Selecione um equipamento</option>
                    @foreach($equipamentos as $equipamento)
                    <option value="{{ $equipamento->id }}">{{ $equipamento->nome }}</option>
                    @endforeach
                </select>
                <button type="button" class="btn btn-outline-success btn-sm" onclick="addEquipamento()">+</button>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100 mb-2">Salvar</button>
        <a href="{{ route('reservas.index') }}" class="btn btn-secondary w-100">Voltar</a>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Populate the first select with existing options if needed
    const selects = document.querySelectorAll('select[name="equipamentos[]"]');
    selects.forEach(select => populateEquipamentoOptions(select));
});

function populateEquipamentoOptions(select) {
    const equipamentos = @json($equipamentos);
    const currentValue = select.value;

    select.innerHTML = '<option value="">Selecione um equipamento</option>';
    equipamentos.forEach(equipamento => {
        const option = document.createElement('option');
        option.value = equipamento.id;
        option.textContent = equipamento.nome;
        if (currentValue == equipamento.id) {
            option.selected = true;
        }
        select.appendChild(option);
    });
}

function addEquipamento() {
    const container = document.getElementById('equipamentos-container');
    const newField = document.createElement('div');
    newField.classList.add('equipamento-field', 'd-flex', 'align-items-center', 'mb-2');

    const select = document.createElement('select');
    select.name = 'equipamentos[]';
    select.classList.add('form-select', 'me-2');
    select.required = true;

    populateEquipamentoOptions(select);

    const removeButton = document.createElement('button');
    removeButton.type = 'button';
    removeButton.classList.add('btn', 'btn-outline-danger', 'btn-sm', 'ms-2');
    removeButton.textContent = 'X';
    removeButton.onclick = function() {
        removeEquipamento(newField);
    };

    newField.appendChild(select);
    newField.appendChild(removeButton);
    container.appendChild(newField);
}

function removeEquipamento(field) {
    const container = document.getElementById('equipamentos-container');
    if (container.children.length > 1) {
        container.removeChild(field);
    } else {
        alert('Você deve manter pelo menos um equipamento.');
    }
}
</script>
@endsection