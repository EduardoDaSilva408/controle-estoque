function list(){
    fetch('cupons/list', {
        method: 'GET'
    }).then(response => response.json())
    .then(cupons => {
        var html = '';
        for(let cupom of cupons){
            html += `
                <tr>
                    <td>${cupom.cupom_id}</td>
                    <td>${cupom.codigo}</td>
                    <td>${cupom.valor}</td>
                    <td>${new Date(cupom.vencimento).toLocaleDateString('pt-br')}
                    <td><!-- Botão Editar -->
                        <button class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold px-3 py-1 rounded shadow" onclick="openModalEdit(${cupom.cupom_id})">
                            Editar
                        </button>
                        <!-- Botão Apagar -->
                        <button class="bg-red-500 hover:bg-red-600 text-white font-semibold px-3 py-1 rounded shadow" onclick="deletaCupom(${cupom.cupom_id})">
                            Apagar
                        </button>
                    </td>
                </tr>
            `;
        }
        document.getElementById('tabela-cupons').innerHTML = html;
    })
}

list()