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
          <h2>Notas do projeto:</h2>
          <div id="notas_projeto">
            ${data.dados.notas_projeto.map(nota => `
              <div class="nota">
                <h3 class="titulo_nota">Nome: ${nota.nome_nota}</h3>
                <p class="descricao_nota">Descrição:<br>${nota.descricao_nota}</p>
                <p class="data_nota">Data: ${nota.data_criacao}</p>
                <button class="alterar_nota" id="alterar_nota_${nota.id_nota}">Alterar</button>
                <button class="excluir_nota" id="excluir_nota_${nota.id_nota}">Excluir</button>
              </div>
            `).join('')}
          </div>
        </div>
      `;
      document.querySelectorAll('.excluir_nota').forEach(button => {
        button.addEventListener("click", function() {
          const id_nota = button.id.split('_')[2];
          fetch('http://localhost:8000/secunde_page/get_project.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id_nota: id_nota })
          })
          .then(response => response.json())
          .then(data => {
            location.reload();
          })
          .catch(error => {
            console.error('Erro ao excluir nota:', error);
          });
        });
      });
      document.querySelectorAll(".alterar_nota").forEach(button => {
        button.addEventListener("click", function() {
          const nota_selecionada = data.dados.notas_projeto[button.id.split('_')[2]];
          
          const overlay = document.createElement('div');
          overlay.id = 'overlay_alterar_nota';
          overlay.style.position = 'fixed';
          overlay.style.top = 0;
          overlay.style.left = 0;
          overlay.style.width = '100%';
          overlay.style.height = '100%';
          overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
          overlay.style.display = 'flex';
          overlay.style.justifyContent = 'center';
          overlay.style.alignItems = 'center';
          overlay.style.zIndex = 9999;

          const modal = document.createElement('div');
          modal.innerHTML = `
            <h2>Alterar Nota</h2>
            <form id="form_alterar_nota">
              <input type="hidden" id="id_nota" name="id_nota" value="${nota_selecionada.id_nota}">
              <label for="nome_nota">Nome da nota:</label>
              <input type="text" id="nome_nota" name="nome_nota" value="${nota_selecionada.nome_nota}">
              <br>
              <label for="descricao_nota">Descrição da nota:</label>
              <textarea id="descricao_nota" name="descricao_nota" required>${nota_selecionada.descricao_nota}</textarea>
              <br>
              <button type="submit">Alterar Nota</button>
              <button type="submit" id="fechar_modal">Fechar</button>
            </form>
          `;
          overlay.appendChild(modal);
          document.body.appendChild(overlay);

          document.getElementById('fechar_modal').addEventListener('click', function() {
            document.body.removeChild(overlay);
          });
          
        });
      });


      document.addEventListener('submit', function(e) {
        e.preventDefault();

        const formulario = e.target;

        const informacao_nova_nota = {
          id_nota: formulario.querySelector('#id_nota') ? formulario.querySelector('#id_nota').value : null,
          nome_nota: formulario.querySelector('#nome_nota').value,
          descricao_nota: formulario.querySelector('#descricao_nota').value
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
          console.error('Erro ao alterar nota:', error);
        });
      });
 
    })
    .catch(error => {
      console.error('Erro:', error);
  });
  
}

selecionando_projeto();
