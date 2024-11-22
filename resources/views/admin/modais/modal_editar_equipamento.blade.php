<div class="modal fade" id="modalEditarEquipamento-{{ $equipamento->id }}" tabindex="-1"
    aria-labelledby="modalEditarEquipamentoLabel-{{ $equipamento->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarEquipamentoLabel-{{ $equipamento->id }}">
                    Editar Equipamento: {{ $equipamento->nome }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.equipamentos.update', $equipamento->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nomeEquipamentoEdit-{{ $equipamento->id }}" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nomeEquipamentoEdit-{{ $equipamento->id }}"
                            name="nome" value="{{ $equipamento->nome }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="descricaoEquipamentoEdit-{{ $equipamento->id }}"
                            class="form-label">Descrição</label>
                        <textarea class="form-control" id="descricaoEquipamentoEdit-{{ $equipamento->id }}"
                            name="descricao" rows="3" required>{{ $equipamento->descricao }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="quantidadeEquipamentoEdit-{{ $equipamento->id }}"
                            class="form-label">Quantidade</label>
                        <input type="number" class="form-control" id="quantidadeEquipamentoEdit-{{ $equipamento->id }}"
                            name="quantidade" min="1" value="{{ $equipamento->quantidade }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>