<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-semibold">Gerenciamento de Produtos</h1>
        <button onclick="openModalAdd()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Novo Produto
        </button>
    </div>

    <table class="w-full text-left border border-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border-b">ID</th>
                <th class="p-2 border-b">Nome</th>
                <th class="p-2 border-b">Preço</th>
                <th class="p-2 border-b">Ações</th>
            </tr>
        </thead>
        <tbody id="tabela-produtos">
            <!-- Linhas geradas dinamicamente -->
        </tbody>
    </table>
</div>

<!-- Modal -->
<div id="produtoModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
   
    <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-6 relative">
        <form action="/produtos/add" id="form-produto" method="post">

            <!-- Botão Fechar -->
            <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800">
                &times;
            </button>

            <h2 class="text-xl font-semibold mb-4" id="title-modal-produtos">Adicionar Produto</h2>

            <input type="hidden" id="produto-id">

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Nome do Produto:</label>
                <input type="text" name="nome" id="produto-nome" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Variação:</label>
                <input type="text" id="produto-variacao" name="variacoes" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Preço:</label>
                <input type="number" id="produto-preco" name="preco" step="0.01" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
            </div>

            <!--Estoque-->
            <h3 class="text-xl font-semibold mb-4" id="title-modal-produtos">Adicionar Produto</h3>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Quantidade:</label>
                <input type="number" id="estoque-quantidade" name="quantidade" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
            </div>

            <div class="flex justify-end space-x-2">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Salvar
                </button>
                <button type="button" onclick="closeModal()" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>
