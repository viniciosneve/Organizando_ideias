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

$nome_projeto = $dados_entrada['nome_projeto'] ?? null;
$descricao_projeto = $dados_entrada['descricao_projeto'] ?? null;

function dados_do_arquivo_json () {
    $arquivo = '../armazenando_projetos.json';
    if (!file_exists($arquivo)) {
        file_put_contents($arquivo, json_encode([]));
    }
    return json_decode(file_get_contents($arquivo), true);
}

function salvar_dados_no_arquivo_json($dados) {
    $arquivo = '../armazenando_projetos.json';
    file_put_contents($arquivo, json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

$dados_armazenados_no_json = dados_do_arquivo_json();

$dados_armazenados_no_json['projetos'][] = [
    'id' => count($dados_armazenados_no_json['projetos']) + 1,
    'nome_projeto' => $nome_projeto,
    'descricao_projeto' => $descricao_projeto,
    'data_criacao' => date('Y-m-d H:i:s'),
    'notas_projeto' => []
];

salvar_dados_no_arquivo_json($dados_armazenados_no_json);

header('Content-Type: application/json');

echo json_encode([
    "mensagem" => "Novo item adicionado com sucesso",
    "nome_projeto" => $nome_projeto,
    "descricao_projeto" => $descricao_projeto,
    "dados" => dados_do_arquivo_json()
]);

?>