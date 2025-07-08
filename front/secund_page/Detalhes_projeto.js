function selecionando_projeto() {
  fetch('http://localhost:8000/secunde_page/project.php')
    .then(response => response.json())
    .then(data => {
      console.log('Projeto selecionado:', data);
    })
    .catch(error => {
      console.error('Erro:', error);
  });
  
}

selecionando_projeto();