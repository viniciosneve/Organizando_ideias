# Organizando_ideias

## Descrição
 Um site a onde você consegue organizar as suas ideia e separa em partes para saber
cada etapa em que você se encontra para a continuação ou a finalização do projeto.

## Tecnologias utilizadas
- HTML5
- JavaScript
- PHP (sem framework)
- JSON (como banco de dados simples)

## Frontend e backend:
1. Abra o servidor frontend na pasta 'front' e o backend na pasta 'back'
2. Para o frontend use o comando http-server
3. Para o backend use o comando php -S localhost:8000 

## Detalhes:
### Observação:
Hoje fiz algumas mudanças, como eu demorei um pouco e me destrair algumas vezes vou ser bem breve sem detalhar muito o que fiz hoje, pois passou da hora de eu sair do computador.

Bom, finalizei a funcionalidade que exclui as notas e imendei e fiz com que os index se reorganizassem, junto com isso fiz com que os ID's das notas não ficassem para trás e coloquei com que os ID's da notas tinha o mesmo valor do index da nota.

Em seguida quando eu ia fazer o mesmo com os projetos, vi que dava para refatorar uma parte do código pois para mim parecia errado e eu tinha que fazer algo a respeito, demorei um tempo mas finalizei a tempo, eu não ia conseguir continuar sabendo que eu poderia melhorar aquilo.

Após isso fiz a funcionalidade de excluir projetos, que foi praticamente a mesma coisa que excluir as notas.

Por fim a todo momento fiz o máximo de testes possiveis para tirar as minhas duvidas e ter certeza que eu estava indo no caminho certo.

### Ideias razas do que imagino do site:
 A ideia também é criar uns botões em cada projeto exibido, que redireciona para uma
outra pagina ou que modifica a pagina toda para criar e colocar detalhes e passos do que será feito para a progressão do projeto, e cada detalhe e/ou passo a passo sera registrado na chave 'notas_projeto' que tem em cada projeto armazenado no arquivo JSON (que eventualmente vou substituir por SQL), e terá um formulário em cima para criar uma nova nota, também tera botões como excluir e editar em cada nota.

### Código
 Cada nome de função, variáveis e etc, tem um nome curto mas que dita a sua função no
código, cada parte do nome é saparado pelo caractere underline ( _ ), exemplo, "nome_novo_projeto", "funcao_adiciona_novo_projeto", "funcao_adiciona_novo_dado_arquivo".

 A forma que estou utilizando para encaminhar os dados recebido pelo lado do cliente
e mandando para o lado do servidor e o CORS.

 O motivo do arquivo "armazenamento_projetos.json" está na pasta "back" - é para que
outros arquivos .php futuros tenham acesso a ele sem precisar entrar na pasta "first".

 A ideia é ter arquivos do lado do servidor distintos para tratar de cada 
funcionalidade específico do projeto, e tenho a ideia de implementar isso para os arquivos do lado do cliente, mas ainda não tenho certeza disso.

 Os servidores seram abertos na pasta raiz, 'back' para o backend e a pasta 'front' para o frontend.

 O arquivo "armazenamento_projetos.json" deve seguir a seguinte estrutura: "
{"projetos" : [{ "id": n, "nome_projeto": "nome do projeto", "descricao_projeto": "descrição do projeto", "data_criacao": "2025-06-25 00:33:44", "notas_projeto": [] }]}". O arquivo "get_new_project.php" já coloca o id de acordo com a quantidade de projeto existente, (não atualizar por enquanto), pretendo alterar para que novos projetos não recebem ids incorretos. 
 
 Nome do projetos não precisam necessáriamente receber um nome, eles seram
identidicados pelo id, e a descrição deve ser preenchida.

 A data de criação é colocado altomaticamente pelo arquivo "get_new_project.php".

 Acredito que não tem muito o que explicar sobre as variáveis e funções no arquivo
"gerencia_json.php", mas vou explicar de forma bem breve as funções:

- função "dados_do_arquivo_json" -> Usado para pegar os dados do arquivo JSON em especifico o "armazenamento_projetos.json". Pretendo pensar em tornar essa função mais eficiente de alguma forma.

- função "salvar_dados_no_arquivo_json" -> Usado para armazenar os novos dados dentro do arquivo "armazenamento_projetos.json". Pretendo pensar em tornar essa função mais eficiente de alguma forma.

 Bom como novas funções foram criadas no aquivo "Novo_projeto.js" vou esta explicando
aqui para que serve cada um deles:

- função "exibir_projetos" -> Ele recebe os dados armazenado no "armazenamento_projetos.json" e adicionar em uma div todos os projetos existentes.

- função "carregar_projetos" -> Essa função vai até no arquivo "get_new_project.php" para pegar os dados armazenado no "armazenamento_projetos.json" e chama a função "exibir_projetos" para enviar os dados e o mesmo exibir os projetos.

- função "selecionando_projeto" -> Essa função deve pegar o ID do projeto selecionado para adicionar/atualizar/excluir notas do projeto, e enviar para o servidor no arquivo "project.php" e por fim redirecionar para a pagina "Detalhes_projeto.html".

o arquivo "Detalhes_projeto.js" tem uma única função, usado para pegar os dados do projeto selecionado no arquivo "get_project.php" e fazer com exiba os detalhes do projeto e que permite o usuário criar uma nota para ser adicionado no projeto.

O arquivo "get_project.php" passou a ter a seguinte função "pegando_projeto()", o mesmo serve para pegar os projetos armezandos no arquivo "armazenamento_projetos.json", e o motivo da criação dessa função é para não repetir o mesmo bloco de código duas vezes no arquivo.

### Problema atual: