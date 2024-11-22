@extends('layouts.app')

@section('content')
<h3 class="text-center">Área Administrativa</h3>
<div class="container mt-4">
    <ul class="nav nav-tabs" id="adminTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="professores-tab" data-bs-toggle="tab" data-bs-target="#professores"
                type="button" role="tab" aria-controls="professores" aria-selected="true">
                Professores
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="ambientes-tab" data-bs-toggle="tab" data-bs-target="#ambientes" type="button"
                role="tab" aria-controls="ambientes" aria-selected="false">
                Ambientes
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="equipamentos-tab" data-bs-toggle="tab" data-bs-target="#equipamentos"
                type="button" role="tab" aria-controls="equipamentos" aria-selected="false">
                Equipamentos
            </button>
        </li>
    </ul>

    <div class="tab-content mt-4" id="adminTabsContent">
        <!-- Professores -->
        <div class="tab-pane fade show active" id="professores" role="tabpanel" aria-labelledby="professores-tab">
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCadastrarProfessor">
                Cadastrar Professor
            </button>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>CPF</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($professores as $professor)
                    <tr>
                        <td>{{ $professor->name }}</td>
                        <td>{{ $professor->email }}</td>
                        <td>{{ $professor->cpf }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalEditarProfessor-{{ $professor->id }}">Editar</button>
                            <form action="{{ route('admin.professores.destroy', $professor->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">Excluir</button>
                            </form>
                        </td>
                    </tr>
                    @include('admin.modais.modal_editar_professor', ['professor' => $professor])
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Ambientes -->
        <div class="tab-pane fade" id="ambientes" role="tabpanel" aria-labelledby="ambientes-tab">
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCadastroAmbiente">
                Cadastrar Ambiente
            </button>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ambientes as $ambiente)
                    <tr>
                        <td>{{ $ambiente->nome }}</td>
                        <td>{{ $ambiente->descricao }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalEditarAmbiente-{{ $ambiente->id }}">Editar</button>
                            <form action="{{ route('admin.ambientes.destroy', $ambiente->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">Excluir</button>
                            </form>
                        </td>
                    </tr>
                    @include('admin.modais.modal_editar_ambiente', ['ambiente' => $ambiente])
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Equipamentos -->
        <div class="tab-pane fade" id="equipamentos" role="tabpanel" aria-labelledby="equipamentos-tab">
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCadastroEquipamento">
                Cadastrar Equipamento
            </button>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Quantidade</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($equipamentos as $equipamento)
                    <tr>
                        <td>{{ $equipamento->nome }}</td>
                        <td>{{ $equipamento->descricao }}</td>
                        <td>{{ $equipamento->quantidade }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalEditarEquipamento-{{ $equipamento->id }}">Editar</button>
                            <form action="{{ route('admin.equipamentos.destroy', $equipamento->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">Excluir</button>
                            </form>
                        </td>
                    </tr>
                    @include('admin.modais.modal_editar_equipamento', ['equipamento' => $equipamento])
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('admin.modais.modal_cadastrar_professor')
@include('admin.modais.modal_cadastrar_ambiente')
@include('admin.modais.modal_cadastrar_equipamento')

@endsection