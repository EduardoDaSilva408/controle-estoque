function list(){
    fetch('produtos/list', {
        method: 'GET'
    }).then(response => response.json())
    .then(produtos => {
        var html = '';
        for(let produto of produtos){
            console.log(JSON.parse(localStorage.getItem('cart') || '[]').includes(produto.produtos_id))
            html += `
                <tr>
                    <td>${produto.produtos_id}</td>
                    <td>${produto.nome}</td>
                    <td>${produto.preco}</td>
                    <td><!-- Botão Editar -->
                        <button class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold px-3 py-1 rounded shadow" onclick="openModalEdit(${produto.produtos_id})">
                            Editar
                        </button>

                        <!-- Botão Apagar -->
                        <button class="bg-red-500 hover:bg-red-600 text-white font-semibold px-3 py-1 rounded shadow" onclick="deletaProduto(${produto.produtos_id})">
                            Apagar
                        </button>
                        <button class="bg-green-500 hover:bg-green-600 text-white font-semibold px-3 py-1 rounded shadow" onclick="openCart(${produto.produtos_id})">
                            Comprar
                        </button>
                    </td>
                </tr>
            `;
        }
        document.getElementById('tabela-produtos').innerHTML = html;
    })
}

list()