document.querySelectorAll('form').forEach(function(form) {

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const url = form.getAttribute('action');
        const method = form.getAttribute('method') || 'POST';

        const formData = new FormData(form);
        fetch(url, {
            method: method.toUpperCase(),
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            Swal.fire({
                title: "Enviado!",
                text: data.message || 'dados recebidos corretamente',
            }).then(() => {
                form.reset();
                if(typeof closeModal === 'function'){
                    closeModal();
                }
                if (typeof list === 'function') {
                    list(); // Chama list() se ela estiver definida
                }
            });
        })
        .catch(error => {
            console.error('Erro:', error);
        });

    });

});