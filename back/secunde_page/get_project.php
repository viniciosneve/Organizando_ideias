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
$projeto_selecionado = dados_do_arquivo_json($arquivo_com_projeto_selecionado);
$projeto_selecionado = $projeto_selecionado['projeto']['id'];

if (!isset($projeto_selecionado) || $projeto_selecionado == '') {
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

$arquivo_com_os_projetos = 'armazenando_projetos.json';
$projetos = dados_do_arquivo_json($arquivo_com_os_projetos);
$projetos = $projetos['projetos'];

if (!is_file($arquivo_com_os_projetos)) {
    header('Content-Type: application/json');
    echo json_encode([
        "erro" => "Arquivo com os projetos não foi encontrado."
    ]);
    exit();
}

foreach ($projetos as $projeto) {
    if ($projeto['id'] == $projeto_selecionado) {
        $projeto_selecionado = $projeto;
        break;
    }
}

header('Content-Type: application/json');
echo json_encode([
    "dados" => $projeto_selecionado
]);

?>