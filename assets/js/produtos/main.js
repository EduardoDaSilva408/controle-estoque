function openModalAdd() {
    document.getElementById('form-produto').action = 'produtos/add';
    document.getElementById('form-produto').method = 'POST';
    document.getElementById('produtoModal').classList.remove('hidden');
    document.getElementById('form-produto').reset();
    document.getElementById('title-modal-produtos').innerHTML = 'Adicionar Produto';
}

function closeModal() {
    document.getElementById('produtoModal').classList.add('hidden');
}

async function openModalEdit(produtos_id){
    const produto = await getProdutosById(produtos_id);
    document.getElementById('form-produto').action = `produtos/${produtos_id}/edit`;
    document.getElementById('form-produto').method = 'POST';
    document.getElementById('produtoModal').classList.remove('hidden');
    
    //Preenche o form.
    document.getElementById('produto-nome').value = produto.nome;
    document.getElementById('produto-variacao').value = produto.variacoes;
    document.getElementById('produto-preco').value = produto.preco;
    document.getElementById('produto-id').value = produtos_id;
    document.getElementById('estoque-quantidade').value = produto.quantidade;

    document.getElementById('title-modal-produtos').innerHTML = 'Editar Produto';
}

async function getProdutosById(produtos_id) {
    const response = await fetch(`produtos/${produtos_id}`);
    const data = await response.json();
    return data;
}

async function deletaProduto(produtos_id){
    const response = await fetch(`produtos/${produtos_id}/delete`);
    const data = await response.json();
    list();
    return data;
}

function addToCart(produtos_id){
    var cart = localStorage.getItem('cart') || [];
    cart.push(produtos_id);
    localStorage.setItem('cart', cart)
}