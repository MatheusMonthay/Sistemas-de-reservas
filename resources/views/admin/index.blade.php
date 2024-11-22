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
                            <button class="btn btn-warning btn-sm">Editar</button>
                            <button class="btn btn-danger btn-sm">Excluir</button>
                        </td>
                    </tr>
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
                            <button class="btn btn-warning btn-sm">Editar</button>
                            <button class="btn btn-danger btn-sm">Excluir</button>
                        </td>
                    </tr>
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
                            <button class="btn btn-warning btn-sm">Editar</button>
                            <button class="btn btn-danger btn-sm">Excluir</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal para Cadastro de Professor -->
<div class="modal fade" id="modalCadastrarProfessor" tabindex="-1" aria-labelledby="modalCadastrarProfessorLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.professores.create') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCadastrarProfessorLabel">Cadastrar Professor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para Cadastro de Ambiente -->
<div class="modal fade" id="modalCadastroAmbiente" tabindex="-1" aria-labelledby="modalCadastroAmbienteLabel"
    aria-hidden="true">
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.ambientes.create') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCadastroAmbiente">Cadastrar Ambiente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome do Ambiente</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para Cadastro de Equipamento -->
<div class="modal fade" id="modalCadastroEquipamento" tabindex="-1" aria-labelledby="modalCadastroEquipamentoLabel"
    aria-hidden="true">
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.equipamentos.create') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCadastroEquipamento">Cadastrar Equipamento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome do Equipamento</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="quantidade" class="form-label">Quantidade</label>
                        <input type="number" class="form-control" id="quantidade" name="quantidade" min="1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection