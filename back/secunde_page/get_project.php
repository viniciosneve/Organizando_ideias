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
$id_nota = $dados_nota['id_nota'] ?? '';
$nome_nota = $dados_nota['nome_nota'] ?? 'Nova nota';
$descricao_nota = $dados_nota['descricao_nota'] ?? '';

if($id_nota != '' && $descricao_nota == '') {
    foreach ($projetos['projetos'][$id_projeto_selecionado]['notas_projeto'] as $nota) {
        $index = array_search($nota, $projetos['projetos'][$id_projeto_selecionado]['notas_projeto']);
        
        if ($nota['id_nota'] == $id_nota) {
            unset($projetos['projetos'][$id_projeto_selecionado]['notas_projeto'][$nota['id_nota']]);
            $projetos['projetos'][$id_projeto_selecionado]['notas_projeto'] = array_values($projetos['projetos'][$id_projeto_selecionado]['notas_projeto']);
        }

        if ($nota['id_nota'] != $index) {
            $projetos['projetos'][$id_projeto_selecionado]['notas_projeto'][$index] = [
                'id_nota' => $index,
                'nome_nota' => $nota['nome_nota'],
                'descricao_nota' => $nota['descricao_nota'],
                'data_criacao' => date('Y-m-d H:i:s')
            ];
        }
    }
    salvar_dados_no_arquivo_json('armazenando_projetos.json', $projetos);
    $projetos = pegando_projeto();
}

if ($id_nota != '' && $descricao_nota != '') {
    foreach ($projetos['projetos'][$id_projeto_selecionado]['notas_projeto'] as $nota) {
        if ($nota['id_nota'] == $id_nota) {
            $projetos['projetos'][$id_projeto_selecionado]['notas_projeto'][$nota['id_nota']] = [
                'id_nota' => $nota['id_nota'],
                'nome_nota' => $nome_nota,
                'descricao_nota' => $descricao_nota,
                'data_criacao' => date('Y-m-d H:i:s')
            ];
            salvar_dados_no_arquivo_json('armazenando_projetos.json', $projetos);
            $projetos = pegando_projeto();
            break;
        }
    }
}

if ($descricao_nota != '' && $id_nota == '') {
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
    /*"id" => $id_nota,*/
    "dados" => $projeto_selecionado
]);

?>