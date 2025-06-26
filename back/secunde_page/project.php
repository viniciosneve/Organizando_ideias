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

$id_projeto = $dados_entrada['id'];

echo "id do projeto: $id_projeto\n";
?>