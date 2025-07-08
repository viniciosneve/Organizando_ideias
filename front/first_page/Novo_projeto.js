//const { createElement } = require("react");

let projetos_criados = [];

document.getElementById('form_criar_projeto').addEventListener('submit', function (e) {
  e.preventDefault();

  const informacao_novo_projeto = {
    nome_projeto: document.getElementById('nome_projeto').value,
    descricao_projeto: document.getElementById('descricao_projeto').value
  };

  fetch('http://localhost:8000/first_page/get_new_project.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(informacao_novo_projeto)
    
  })
    .then(response => response.json())
    .then(data => {
      document.getElementById('form_criar_projeto').reset();
    })
    .catch(error => {
      console.error('Erro:', error);
    });
});

function carregar_projetos() {
  fetch('http://localhost:8000/first_page/get_new_project.php')
    .then(response => response.json())
    .then(data => {
      projetos_criados = data.dados['projetos'];
      exibir_projetos(projetos_criados);
    })
    .catch(error => {
      console.error('Erro ao carregar projetos:', error);
    });
}

function exibir_projetos(projetos) {
  const container = document.getElementById('projetos_criados');

  projetos.forEach(projeto => {
    const div = document.createElement('div');
    div.classList.add('projetos');
    div.id = projeto.id;
    div.innerHTML = `
      <h2>${projeto.nome_projeto}</h2>
      <p>Descrição: ${projeto.descricao_projeto}</p>
      <p>Data criação: ${projeto.data_criacao}</p>
      <button type="submit" id="excluir_${projeto.id}" class="botao_excluindo_projeto">Excluir Projeto</button>
    `;
    const botao_selecionando_projeto = document.createElement('button');
    botao_selecionando_projeto.classList.add('botao_selecionando_projeto');
    botao_selecionando_projeto.innerHTML = 'Selecionar Projeto';
    botao_selecionando_projeto.id = `selecionar_${projeto.id}`;
    botao_selecionando_projeto.type = 'submit';
    botao_selecionando_projeto.onclick = () => {selecionando_projeto(projeto.id);};
    div.appendChild(botao_selecionando_projeto);

    container.appendChild(div);
  });
}

function selecionando_projeto(projeto) {
  fetch('http://localhost:8000/secunde_page/project.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(projeto)

  })
    .then(response => response.json())
    .catch(error => {
      console.error('Erro:', error);
  });

  location.assign("/secund_page/Detalhes_projeto.html");
  
}

carregar_projetos();