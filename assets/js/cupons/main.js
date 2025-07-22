function openModalAdd() {
    document.getElementById('form-produto').action = 'cupons/add';
    document.getElementById('form-produto').method = 'POST';
    document.getElementById('produtoModal').classList.remove('hidden');
    document.getElementById('form-produto').reset();
    document.getElementById('title-modal-cupons').innerHTML = 'Adicionar Cupom';
}

function closeModal() {
    document.getElementById('produtoModal').classList.add('hidden');
    document.getElementById("cartModal").classList.add('hidden');te
}

async function openModalEdit(cupom_id){
    const produto = await getCupomsById(cupom_id);
    document.getElementById('form-produto').action = `cupons/${cupom_id}/edit`;
    document.getElementById('form-produto').method = 'POST';
    document.getElementById('produtoModal').classList.remove('hidden');
    
    //Preenche o form.
    document.getElementById('produto-nome').value = produto.nome;
    document.getElementById('produto-variacao').value = produto.variacoes;
    document.getElementById('produto-preco').value = produto.preco;
    document.getElementById('produto-id').value = cupom_id;
    document.getElementById('estoque-quantidade').value = produto.quantidade;

    document.getElementById('title-modal-cupons').innerHTML = 'Editar Cupom';
}

async function getCupomsById(cupom_id) {
    const response = await fetch(`cupom/${cupom_id}`);
    const data = await response.json();
    return data;
}

async function deletaCupom(cupom_id){
    const response = await fetch(`cupom/${cupom_id}/delete`);
    const data = await response.json();
    list();
    return data;
}

function addToCart(cupom_id) {
    // Recupera o carrinho existente ou cria um novo array
    var cart = JSON.parse(localStorage.getItem('cart') || '[]');

    // Adiciona o ID ao carrinho
    if(!cart.includes(cupom_id)){
        cart.push(cupom_id)
    }
    
    console.log(cart)
    // Armazena o carrinho atualizado
    localStorage.setItem('cart', JSON.stringify(cart));
    list();
}

function removeToCart(cupom_id){
     var cart = JSON.parse(localStorage.getItem('cart') || '[]');

      if(cart.includes(cupom_id)){
        cart.pop(cupom_id)
    }
    localStorage.setItem('cart', JSON.stringify(cart));
    list();
}

 new TomSelect(".cupom_id", {
        valueField: 'value',
        labelField: 'text',
        searchField: 'text',

        load: function(query, callback) {
            if (!query.length) return callback();

            fetch('/cupom/select2?q=' + encodeURIComponent(query))
                .then(response => response.json())
                .then(data => {
                    callback(data); // Deve ser um array [{value:'', text:''}, ...]
                }).catch(() => {
                    callback(); // Em caso de erro
                });
        }
    });
