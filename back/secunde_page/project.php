<?php
require_once __DIR__ . '/../gerencia_json.php';

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
$nome_arquivo_json = 'pegando_projeto.json';

$projeto_selecionado = dados_do_arquivo_json($nome_arquivo_json);

$projeto_selecionado['projeto'] = [
    'id' => $id_projeto
];

if ($id_projeto != '') {
    salvar_dados_no_arquivo_json($nome_arquivo_json, $projeto_selecionado);
}
?>