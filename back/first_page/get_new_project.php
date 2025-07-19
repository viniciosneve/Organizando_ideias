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

$nome_projeto = $dados_entrada['nome_projeto'] ?? 'Novo Projeto';
$descricao_projeto = $dados_entrada['descricao_projeto'] ?? '';

$nome_arquivo_json = 'armazenando_projetos.json';

$dados_armazenados_no_json = dados_do_arquivo_json($nome_arquivo_json);

$dados_armazenados_no_json['projetos'][] = [
    'id' => count($dados_armazenados_no_json['projetos']),
    'nome_projeto' => $nome_projeto,
    'descricao_projeto' => $descricao_projeto,
    'data_criacao' => date('Y-m-d H:i:s'),
    'notas_projeto' => []
];


if ($descricao_projeto != '') {
    salvar_dados_no_arquivo_json($nome_arquivo_json, $dados_armazenados_no_json);
}

header('Content-Type: application/json');

echo json_encode([
    "dados" => dados_do_arquivo_json($nome_arquivo_json)
]);

?>