function selecionando_projeto() {
  fetch('http://localhost:8000/secunde_page/get_project.php')
    .then(response => response.json())
    .then(data => {
      console.log('Dados do projeto:', data);
      document.getElementById('projeto_selecionado').innerHTML = `
        <div id="div_form_criar_notas">
          <h2>Criando novas notas</h2>
          <form id="form_criar_notas">
            <label for="nome_nota">Nome da nota:</label>
            <input type="text" id="nome_nota" name="nome_nota" required>
            <br>
            <label for="descricao_nota">Descrição da nota:</label>
            <textarea id="descricao_nota" name="descricao_nota" required></textarea>
            <br>
            <button type="submit" id="botao_criar_nota">Criar Nota</button>
          </form>
        </div>
        <div id= "detalhes_projeto">
          <h2>Detalhes do Projeto</h2>
          <p>ID: ${data.dados.id}</p>
          <p>Nome: ${data.dados.nome_projeto}</p>
          <p>Descrição: ${data.dados.descricao_projeto}</p>
          <p>Data de Criação: ${data.dados.data_criacao}</p>
          <h2>Notas do projeto:</h2>
          <div id="notas_projeto">
            ${data.dados.notas_projeto.map(nota => `
              <div class="nota">
                <h3 class="titulo_nota">Nome: ${nota.nome_nota}</h3>
                <p class="descricao_nota">Descrição:<br>${nota.descricao_nota}</p>
                <p class="data_nota">Data: ${nota.data_criacao}</p>
              </div>
            `).join('')}
          </div>
        </div>
      `;
      document.getElementById('form_criar_notas').addEventListener('submit', function (e) {
        e.preventDefault();

        const informacao_nova_nota = {
          nome_nota: document.getElementById('nome_nota').value,
          descricao_nota: document.getElementById('descricao_nota').value
        };

        fetch('http://localhost:8000/secunde_page/get_project.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(informacao_nova_nota)
        })
        .then(response => response.json())
        .then(data => {
          location.reload();
        })
        .catch(error => {
          console.error('Erro ao criar nota:', error);
        });
      });
    })
    .catch(error => {
      console.error('Erro:', error);
  });
  
}

selecionando_projeto();













/**/