<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-semibold">Gerenciamento de Cupons</h1>
        <div>
            <button onclick="openModalAdd()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Novo Cupom
            </button>
        </div>
        
    </div>

    <table class="w-full text-left border border-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border-b">ID</th>
                <th class="p-2 border-b">Codigo</th>
                <th class="p-2 border-b">Valor</th>
                <th class="p-2 border-b">Vencimento</th>
                <th class="p-2 border-b">Ação</th>
            </tr>
        </thead>
        <tbody id="tabela-cupons">
            <!-- Linhas geradas dinamicamente -->
        </tbody>
    </table>
</div>

<!-- Modal -->
<div id="cupomModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
   
    <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-6 relative">
        <form action="/cupons/add" id="form-cupom" method="post">

            <!-- Botão Fechar -->
            <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800">
                &times;
            </button>

            <h2 class="text-xl font-semibold mb-4" id="title-modal-cupons">Adicionar Cupom</h2>

            <input type="hidden" id="cupom_id">
            <div>
                <label>Produto: </label>
                <select name="produtos_id" id="cupom-produtos_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 produtos_id" style="width: 100%;"></select>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Código:</label>
                <input type="text" name="codigo" id="cupom-codigo" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Valor:</label>
                <input type="number" id="cupom-valor" name="valor" step="0.01" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">é porcentagem:</label>
                <input type="checkbox" id="cupom-percentual" name="percentual" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Vencimento:</label>
                <input type="datetime-local" id="cupom-vencimento" name="vencimento" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
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