function selecionando_projeto() {
  fetch('http://localhost:8000/secunde_page/get_project.php')
    .then(response => response.json())
    .then(data => {
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
          <p>Notas do projeto: ${data.dados.notas_projeto}</p>
        </div>
      `;
    })
    .catch(error => {
      console.error('Erro:', error);
  });
  
}

selecionando_projeto();













/**/