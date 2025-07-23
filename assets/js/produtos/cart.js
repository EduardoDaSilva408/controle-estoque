async function openCart(produto_id) {
    // renderCartItems();
    document.getElementById('cartModal').classList.remove('hidden');
    document.getElementById('cartModal').classList.add('flex');
    const cartItemsDiv = document.getElementById('cartItems');
    cartItemsDiv.innerHTML = '';
    var produto = await getProdutosById(produto_id);
    const itemDiv = document.createElement('div');
    itemDiv.classList.add('border', 'rounded', 'p-3', 'flex', 'justify-between', 'items-center');

    itemDiv.innerHTML = `
        <div>
            <input type="hidden" name="produtos_id" value="${produto_id}">
            <input type="hidden" name="valor_unitario" value="${produto.preco}">
            <input type="hidden" name="frete" value="" id="cart-frete-input">
            <input type="hidden" name="discount" value="" id="cupom-discount">
            <input type="hidden" name="percent" value="" id="cupom-percent">
            <p class="font-semibold">${produto.nome}</p>
            <p class="text-sm text-gray-500">${produto.variacoes}</p>
        </div>
        <div>
            <input type="number" min="1" max="${produto.quantidade || 1}" value="1" name="quantidade"
                onchange="preencheValorTotal();calculaFrete();"
                class="w-16 border rounded p-1 text-center">
        </div>
    `;

    cartItemsDiv.appendChild(itemDiv);
    calculaFrete();
    preencheValorTotal();
}

function closeCartModal() {
    document.getElementById('cartModal').classList.add('hidden');
    document.getElementById('cartModal').classList.remove('flex');
}

// function renderCartItems() {
//     const cartItemsDiv = document.getElementById('cartItems');
//     const cart = JSON.parse(localStorage.getItem('cart')) || [];

//     cartItemsDiv.innerHTML = '';
//     if (cart.length === 0) {
//         cartItemsDiv.innerHTML = '<p class="text-gray-500">Seu carrinho está vazio.</p>';
//         return;
//     }

//     cart.forEach(async (produto_id, index) => {
//         var produto = await getProdutosById(produto_id);
//         console.log(produto)
//         const itemDiv = document.createElement('div');
//         itemDiv.classList.add('border', 'rounded', 'p-3', 'flex', 'justify-between', 'items-center');

//         itemDiv.innerHTML = `
//             <div>
//                 <input type="hidden" name="pedidos[${index}][produtos_id]" value="${produto_id}">
//                 <p class="font-semibold">${produto.nome}</p>
//                 <p class="text-sm text-gray-500">${produto.variacoes}</p>
//             </div>
//             <div>
//                 <input type="number" min="1" max="${produto.quantidade || 1}" value="1" name="pedidos[${index}][quantidade]"
//                     onchange="updateQuantity(${index}, this.value)" 
//                     class="w-16 border rounded p-1 text-center">
//             </div>
//         `;

//         cartItemsDiv.appendChild(itemDiv);
//     });
// }

// function updateQuantity(index, quantidade) {
//     const cart = JSON.parse(localStorage.getItem('cart')) || [];
//     cart[index].quantidade = parseInt(quantidade);
//     localStorage.setItem('cart', JSON.stringify(cart));
// }

function finalizarPedido() {
    const email = document.getElementById('emailCliente').value.trim();
    const cep = document.getElementById('cepEntrega').value.trim();
    const cart = JSON.parse(localStorage.getItem('cart')) || [];

    if (!email || !cep) {
        alert('Preencha o e-mail e o CEP.');
        return;
    }

    console.log('Pedido finalizado:', { email, cep, cart });
    alert('Pedido enviado!');
    localStorage.removeItem('cart');
    closeCartModal();
}

function preencheValorTotal(){
    var form = document.getElementById('cart-form');
    var valor_total = parseInt(form.quantidade.value) * parseFloat(form.valor_unitario.value) + parseFloat(form.frete.value);
    if(document.getElementById('cupom-discount').value){
        if(document.getElementById('cupom-percent').value == '1'){
            valor_total -= (valor_total / document.getElementById('cupom-discount').value);
        }else{
            valor_total -= document.getElementById('cupom-discount').value;
        }
    }
    console.log(form.frete.value);
    document.getElementById('valor-total-cart').innerText = valor_total.toFixed(2);
}

async function calculaFrete(){
    var form = document.getElementById('cart-form');
    var formData = new FormData();
    formData.append('produtos_id', form.produtos_id.value);
    formData.append('quantidade', form.quantidade.value);

    var frete = await fetch('pedidos/frete', {
        method: 'POST',
        body: formData
    }).then(response => response.json())
    document.getElementById('frete-cart').innerText = "R$ "+ frete;
    document.getElementById('cart-frete-input').value = frete;
    preencheValorTotal();
}

function verifyCupom(cupom_code) {
    fetch('/cupons/code/'+cupom_code, )
        .then(response => response.json())
        .then(data => {
            if(data.valor){
                document.getElementById('cupom-discount').value = data.valor;
                document.getElementById('cupom-percent').value = data.percentual;
                preencheValorTotal();
            }else{
                document.getElementById('cupom-discount').value = '';
                document.getElementById('cupom-percent').value = '';
                preencheValorTotal();
            }
        });
}