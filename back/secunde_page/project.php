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
$id_projeto = $dados_entrada['id'] ?? '';
$action = $dados_entrada['action'] ?? '';

if ($action == 'alterar') {
    $nome_arquivo_json = 'pegando_projeto.json';
    $projeto_selecionado = dados_do_arquivo_json($nome_arquivo_json);
    $projeto_selecionado['projeto'] = [
        'id' => $id_projeto
    ];
    salvar_dados_no_arquivo_json($nome_arquivo_json, $projeto_selecionado);
}
if ($action == 'excluir') {
    $nome_arquivo_json = 'armazenando_projetos.json';
    $projetos = dados_do_arquivo_json($nome_arquivo_json);
    
    foreach ($projetos['projetos'] as $projeto) {
        $index = array_search($projeto, $projetos['projetos']);
        if ($projeto['id'] == $id_projeto) {
            unset($projetos['projetos'][$index]);
            $projetos['projetos'] = array_values($projetos['projetos']);
        }
        if ($projeto['id'] != $index) {
            $projetos['projetos'][$index] = [
                'id' => $index,
                'nome_projeto' => $projeto['nome_projeto'],
                'descricao_projeto' => $projeto['descricao_projeto'],
                'data_criacao' => $projeto['data_criacao'],
                'notas_projeto' => $projeto['notas_projeto']
            ];
        }
    }
    salvar_dados_no_arquivo_json($nome_arquivo_json, $projetos);
}
?>