function openModalAdd() {
    document.getElementById('form-produto').action = 'cupons/add';
    document.getElementById('form-produto').method = 'POST';
    document.getElementById('cupomModal').classList.remove('hidden');
    document.getElementById('form-cupom').reset();
    document.getElementById('title-modal-cupons').innerHTML = 'Adicionar Cupom';
}

function closeModal() {
    document.getElementById('cupomModal').classList.add('hidden');
}

async function openModalEdit(cupom_id){
    const cupom = await getCupomsById(cupom_id);
    document.getElementById('form-cupom').action = `cupons/${cupom_id}/edit`;
    document.getElementById('form-cupom').method = 'POST';
    document.getElementById('cupomModal').classList.remove('hidden');
    
    //Preenche o form.
    document.getElementById('cupom-codigo').value = cupom.codigo;
    document.getElementById('cupom-valor').value = cupom.valor;
    document.getElementById('cupom-vencimento').value = cupom.vencimento;
    document.getElementById('cupom_id').value = cupom_id;
    document.getElementById('cupom-percentual').checked = cupom.percentual == '1';
    var newOption = new Option(cupom.nome, cupom.produtos_id, false, false);
    $('#cupom-produtos_id').append(newOption).trigger('change');


    document.getElementById('title-modal-cupons').innerHTML = 'Editar Cupom';
}

async function getCupomsById(cupom_id) {
    const response = await fetch(`cupons/${cupom_id}`);
    const data = await response.json();
    return data;
}

async function deletaCupom(cupom_id){
    const response = await fetch(`cupons/${cupom_id}/delete`);
    const data = await response.json();
    list();
    return data;
}

const produtos = $(".produtos_id").select2({
    allowClear: true,
    ajax: {
      url: "/produtos/select2",
      dataType: 'json',
      delay: 250,
      data: function (params) {
        return {
          q: params.term, // search term
          //page: params.page
        };
      },
      processResults: function (data, params) {
  
        params.page = params.page || 1;
  
        return {
          results: data
        };
      },
  
      cache: true
    },
  })
