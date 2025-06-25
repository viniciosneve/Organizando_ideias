document.getElementById('form_criar_projeto').addEventListener('submit', function (e) {
  e.preventDefault();

  const informacao_novo_projeto = {
    nome_projeto: document.getElementById('nome_projeto').value,
    descricao_projeto: document.getElementById('descricao_projeto').value
  };

  fetch('http://localhost:8000/get_new_project.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(informacao_novo_projeto)
    
  })
    .then(response => response.json())
    .then(data => {
      document.getElementById('form_criar_projeto').reset();
      // Criar uma função que retornar todos os projetos armazenados dentro de divs separando cada projeto com as suas devidas informações
      /*function exibirProjetos(projetos) {
        const container = document.getElementById('projetos_container');
        container.innerHTML = ''; // Limpar conteúdo anterior

        projetos.forEach(projeto => {
          const div = document.createElement('div');
          div.classList.add('projeto');
          div.innerHTML = `
            <h2>${projeto.nome}</h2>
            <p>${projeto.descricao}</p>
          `;
          container.appendChild(div);
        });
      }*/
    })
    .catch(error => {
      console.error('Erro:', error);
    });
});
