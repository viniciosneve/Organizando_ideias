<?php
require_once __DIR__ . '/../gerencia_json.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$arquivo_com_projeto_selecionado = 'pegando_projeto.json';
$id_projeto_selecionado = dados_do_arquivo_json($arquivo_com_projeto_selecionado);
$id_projeto_selecionado = $id_projeto_selecionado['projeto']['id'];

if (!isset($id_projeto_selecionado) || $id_projeto_selecionado == '') {
    header('Content-Type: application/json');
    echo json_encode([
        "erro" => "Nenhum projeto selecionado."
    ]);
    exit();
}

if (!is_file($arquivo_com_projeto_selecionado)) {
    header('Content-Type: application/json');
    echo json_encode([
        "erro" => "Arquivo com o id do projeto selecionado não foi encontrado."
    ]);
    exit();
}

function pegando_projeto() {
    $arquivo_com_os_projetos = 'armazenando_projetos.json';
    if (!is_file($arquivo_com_os_projetos)) {
        header('Content-Type: application/json');
        echo json_encode([
            "erro" => "Arquivo com os projetos não foi encontrado."
        ]);
        exit();
    }
    $projetos = dados_do_arquivo_json($arquivo_com_os_projetos);
    return $projetos;
}

$projetos = pegando_projeto();

$entrada_dados = file_get_contents('php://input');
$dados_nota = json_decode($entrada_dados, true);
$nome_nota = $dados_nota['nome_nota'] ?? 'Nova nota';
$descricao_nota = $dados_nota['descricao_nota'] ?? '';

if($descricao_nota != '') {
    $projetos['projetos'][$id_projeto_selecionado]['notas_projeto'][] = [
        'id_nota' => count($projetos['projetos'][$id_projeto_selecionado]['notas_projeto']),
        'nome_nota' => $nome_nota,
        'descricao_nota' => $descricao_nota,
        'data_criacao' => date('Y-m-d H:i:s')
    ];
    salvar_dados_no_arquivo_json('armazenando_projetos.json', $projetos);
    $projetos = pegando_projeto();
}

foreach ($projetos['projetos'] as $projeto) {
    if ($projeto['id'] == $id_projeto_selecionado) {
        $projeto_selecionado =  $projeto;
    }
}


header('Content-Type: application/json');
echo json_encode([
    "dados" => $projeto_selecionado
]);

?>