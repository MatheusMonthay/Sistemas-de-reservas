@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="text-center mb-4">Ocorrências Registradas</h3>

    @if(session('sucesso'))
    <div class="alert alert-success">
        {{ session('sucesso') }}
    </div>
    @endif

    @if($ocorrencias->isEmpty())
    <div class="alert alert-warning text-center">
        Nenhuma ocorrência registrada.
    </div>
    @else
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Reserva</th>
                <th>Usuário</th>
                <th>Descrição</th>
                <th>Status</th>
                <th>Data</th>
                @if(auth()->user()->role === 'admin')
                <th>Ações</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($ocorrencias as $ocorrencia)
            @if(auth()->user()->role === 'admin' || $ocorrencia->user_id === auth()->user()->id)
            <tr
                class="{{ $ocorrencia->status === 'resolvida' ? 'bg-success' : ($ocorrencia->status === 'pendente' ? 'bg-warning' : 'bg-info') }}">
                <td>{{ $ocorrencia->reserva->ambiente->nome }}</td>
                <td>{{ $ocorrencia->user->name }}</td>
                <td>{{ $ocorrencia->descricao }}</td>
                <td>{{ ucfirst($ocorrencia->status) }}</td>
                <td>{{ \Carbon\Carbon::parse($ocorrencia->reserva->inicio)->format('d/m/Y H:i') }}</td>
                @if(auth()->user()->role === 'admin')
                <td>
                    <a href="{{ route('ocorrencias.edit', $ocorrencia->id) }}" class="btn btn-warning btn-sm">Editar</a>
                </td>
                @endif
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection