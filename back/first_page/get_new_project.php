<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$nome_projeto = $_POST['nome_projeto'] ?? '';
$descricao_projeto = $_POST['descricao_projeto'] ?? '';

$response = [
    'status' => 'success',
    'message' => 'Projeto recebido com sucesso',
    'nome_projeto' => $nome_projeto,
    'descricao_projeto' => $descricao_projeto
];
header('Content-Type: application/json');
echo json_encode($response);
?>