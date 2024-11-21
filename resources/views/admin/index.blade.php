@extends('layouts.app')

@section('content')
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
            <button class="btn btn-primary mb-3">Cadastrar Professor</button>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Professor 1</td>
                        <td>professor1@exemplo.com</td>
                        <td>
                            <button class="btn btn-warning btn-sm">Editar</button>
                            <button class="btn btn-danger btn-sm">Excluir</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Professor 2</td>
                        <td>professor2@exemplo.com</td>
                        <td>
                            <button class="btn btn-warning btn-sm">Editar</button>
                            <button class="btn btn-danger btn-sm">Excluir</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Ambientes -->
        <div class="tab-pane fade" id="ambientes" role="tabpanel" aria-labelledby="ambientes-tab">
            <button class="btn btn-primary mb-3">Cadastrar Ambiente</button>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Laboratório 1</td>
                        <td>Sala equipada para aulas práticas</td>
                        <td>
                            <button class="btn btn-warning btn-sm">Editar</button>
                            <button class="btn btn-danger btn-sm">Excluir</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Sala de Aula 1</td>
                        <td>Sala convencional para aulas teóricas</td>
                        <td>
                            <button class="btn btn-warning btn-sm">Editar</button>
                            <button class="btn btn-danger btn-sm">Excluir</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Equipamentos -->
        <div class="tab-pane fade" id="equipamentos" role="tabpanel" aria-labelledby="equipamentos-tab">
            <button class="btn btn-primary mb-3">Cadastrar Equipamento</button>
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
                    <tr>
                        <td>Projetor</td>
                        <td>Projetor multimídia</td>
                        <td>5</td>
                        <td>
                            <button class="btn btn-warning btn-sm">Editar</button>
                            <button class="btn btn-danger btn-sm">Excluir</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Notebook</td>
                        <td>Notebook para apresentações</td>
                        <td>10</td>
                        <td>
                            <button class="btn btn-warning btn-sm">Editar</button>
                            <button class="btn btn-danger btn-sm">Excluir</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection