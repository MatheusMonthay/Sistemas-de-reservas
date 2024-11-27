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

        <div class="mb-3">
            <label for="equipamentos" class="form-label">Equipamentos</label>
            <div id="equipamentos-container">
                @foreach($equipamentos as $equipamento)
                <div class="d-flex align-items-center mb-2">
                    <select name="equipamentos[]" class="form-select me-2" style="width: 300px;">
                        <option value="{{ $equipamento->id }}" @if($reserva->
                            equipamentos->pluck('id')->contains($equipamento->id)) selected @endif>
                            {{ $equipamento->nome }}
                        </option>
                    </select>
                    <button type="button" class="btn btn-outline-danger btn-sm ms-2"
                        onclick="removeEquipamentoField(this)">X</button>
                    <button type="button" class="btn btn-outline-secondary btn-sm ms-2"
                        onclick="addEquipamentoField()">+</button>
                </div>
                @endforeach
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href="{{ route('reservas.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<script>
function addEquipamentoField() {
    const container = document.getElementById('equipamentos-container');
    const newField = document.createElement('div');
    newField.classList.add('d-flex', 'align-items-center', 'mb-2');

    const select = document.createElement('select');
    select.name = 'equipamentos[]';
    select.classList.add('form-select', 'me-2');
    select.style.width = '300px';

    @foreach($equipamentos as $equipamento)
    const option = document.createElement('option');
    option.value = '{{ $equipamento->id }}';
    option.textContent = '{{ $equipamento->nome }}';
    select.appendChild(option);
    @endforeach

    const buttonRemove = document.createElement('button');
    buttonRemove.type = 'button';
    buttonRemove.classList.add('btn', 'btn-outline-danger', 'btn-sm', 'ms-2');
    buttonRemove.textContent = 'X';
    buttonRemove.onclick = function() {
        removeEquipamentoField(buttonRemove);
    };

    const buttonAdd = document.createElement('button');
    buttonAdd.type = 'button';
    buttonAdd.classList.add('btn', 'btn-outline-secondary', 'btn-sm', 'ms-2');
    buttonAdd.textContent = '+';
    buttonAdd.onclick = function() {
        addEquipamentoField();
    };

    newField.appendChild(select);
    newField.appendChild(buttonRemove);
    newField.appendChild(buttonAdd);
    container.appendChild(newField);
}

function removeEquipamentoField(button) {
    const container = document.getElementById('equipamentos-container');
    container.removeChild(button.parentNode);
}
</script>
@endsection