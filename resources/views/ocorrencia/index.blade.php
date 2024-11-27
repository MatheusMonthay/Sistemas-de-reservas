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
            </tr>
        </thead>
        <tbody>
            @foreach($ocorrencias as $ocorrencia)
            <tr>
                <td>{{ $ocorrencia->reserva->ambiente->nome }}</td>
                <td>{{ $ocorrencia->user->name }}</td>
                <td>{{ $ocorrencia->descricao }}</td>
                <td>{{ ucfirst($ocorrencia->status) }}</td>
                <td>{{ \Carbon\Carbon::parse($ocorrencia->created_at)->format('d/m/Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection