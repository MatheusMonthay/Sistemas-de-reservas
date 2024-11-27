@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="text-center mb-4">Editar Ocorrência</h3>

    @if(session('sucesso'))
    <div class="alert alert-success">
        {{ session('sucesso') }}
    </div>
    @endif

    @if(auth()->user()->role === 'admin')
    <form action="{{ route('ocorrencias.update', $ocorrencia->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="pendente" {{ $ocorrencia->status === 'pendente' ? 'selected' : '' }}>Pendente</option>
                <option value="resolvida" {{ $ocorrencia->status === 'resolvida' ? 'selected' : '' }}>Resolvida</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar Status</button>
    </form>
    @else
    <div class="alert alert-danger text-center">
        Você não tem permissão para editar esta ocorrência.
    </div>
    @endif
</div>
@endsection