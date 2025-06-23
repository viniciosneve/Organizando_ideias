document.getElementById('form_criar_projeto').addEventListener('submit', function (e) {
  e.preventDefault(); // impede envio normal do form

  const formData = new FormData();
  formData.append('nome_projeto', document.getElementById('nome_projeto').value);
  formData.append('descricao_projeto', document.getElementById('descricao_projeto').value);

  fetch('http://localhost:8080/first_page/get_new_project.php', {
    method: 'POST',
    body: formData,
    mode: 'cors' // ativa o modo CORS
  })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erro na resposta do servidor: ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
      console.log('Resposta do servidor:', data);
      console.log('Nome do projeto criado:', data.nome_projeto);
      console.log('Descrição do projeto criado:', data.descricao_projeto);
    })
    .catch(error => {
      console.error('Erro:', error);
    });
});
