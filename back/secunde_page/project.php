<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$entrada_json = file_get_contents('php://input');
$dados_entrada = json_decode($entrada_json, true);

$id_projeto = $dados_entrada ?? '';

function dados_do_arquivo_json () {
    $arquivo = 'pegando_projeto.json';
    return json_decode(file_get_contents($arquivo), true);
}

function salvar_dados_no_arquivo_json($dados) {
    $arquivo = 'pegando_projeto.json';
    file_put_contents($arquivo, json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

$projeto_selecionado = dados_do_arquivo_json();

$projeto_selecionado['projeto'] = [
    'id' => $id_projeto
];

if ($id_projeto != '') {
    salvar_dados_no_arquivo_json($projeto_selecionado);
}

header('Content-Type: application/json');
echo json_encode([
    "dados" => dados_do_arquivo_json()['projeto']['id']
]);
?>