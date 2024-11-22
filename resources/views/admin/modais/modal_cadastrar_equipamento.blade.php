<div class="modal fade" id="modalCadastroEquipamento" tabindex="-1" aria-labelledby="modalCadastroEquipamentoLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCadastroEquipamentoLabel">Cadastrar Equipamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.equipamentos.create') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nomeEquipamento" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nomeEquipamento" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="descricaoEquipamento" class="form-label">Descrição</label>
                        <textarea class="form-control" id="descricaoEquipamento" name="descricao" rows="3"
                            required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="quantidadeEquipamento" class="form-label">Quantidade</label>
                        <input type="number" class="form-control" id="quantidadeEquipamento" name="quantidade" min="1"
                            required>
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