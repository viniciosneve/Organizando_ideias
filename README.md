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
Ontem cheguei do trabalho querendo jogar mas com a vontade mesmo voltado para querer programar, o oposto do que acontecia, eu chegava querendo programar mas com a vontade mesmo de jogar e então desta vez fui programar por que era o que eu queria de verdade, então dei continuidade na funcionalidade que edita os dados das notas para novos dados, comcei a ter problemas quando reparei que ia da ruim pelo simples motivo do formulário ser criado dentro de um loop, tentar colocar uma .addeventlistener dentro da aquilo para mim parecia uma ideia descartável de cara, só que os dados estavam lá e não tinha como eu pegar de outro lugar, mas mesmo assim eu fiz sabendo que poderia não funcionar e claro que não funcionou e nem funcinou quando eu coloquei dentro do loop, ate que descobrir que eu não precisavar chamar o elemento para depois usar o .addeventlistener, era só chamar o document.addEventListener que o mesmo teria os dados do formulário enviado, independente se tinha dois formulário ao mesmo tempo enviado dados para o mesmo destino, o .addeventlistener pega o que tem os dados, então simplifiquei para um que envia os dados indenpendente se era para adicionar uma nova nota ou para atualizar a nota, o que diferencia qual dos dois é, é o id.

depois de um bom tempo tentando entender se o problema era o envio do front para o back, decidir usar um olhar mais fechedo para o achismo, e depois de deixar o front com o código mais limpo decidir aceitar que estava tudo certo pois para mim não tinha nada de errado, pois eu já tinha ate deito diversos teste para saber como os dados estavam enviando e estava tudo certo, por isso decidir finalizar e deixar como estava pois estava tudo certo não tinha nada de errado ao meu ver e de acordo com meu nivel de conhecimento, e claro que eu estava certo quanto a isso.

Em segui fui analisar o back, vi que a forma do PHP pegar os dados estavam corretos e não tinha nada de errado e deixei como estava, depois verifiquei as condições e o loop e estavam certo ao meu ver e ao meu conhecimento, então decidir deixar como estava e errumar os detalhes para não da erro, pois de acordo com o meu achismo baseado em meu conhcimento estavam certo, e de fato estava certo. Então o que sobrava, algo que eu já suspeitava, que era a forma que os dados da nota estava sendo atualizado, para mim não parecia correto desde o inicio, mas eu deixei como estava pois era algo novo e queria tentar algo novo, só que era a única coisa errado no meu julgamento, então decidi alterar para uma forma que eu tinha tentado antes mas que não tinha dado certo, e fazendo essa alteração, essa alteração pois era a única coisa errado, cabou dando certo e conseguir fazer funcionar.

Devo dar mais credibilidade a minha analise critica e logica com relação as coisas, e descarta o que claramente já esta certo para mim.

Estamos cada vez mais perto do fim, só falta agora o botão que remove e altera os IDs para não da problema e decidir se ainda quero envolver o SQL, apois isso eu passo a estilização do site. 

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