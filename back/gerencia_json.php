<?php
function erros ($nome_arquivo_json){
    if (!is_string($nome_arquivo_json)) {
        return trigger_error('O nome do arquivo JSON deve ser uma string.', E_USER_ERROR);
    }
    if (!file_exists($nome_arquivo_json)) {
        return trigger_error('O arquivo JSON não existe: ' . $nome_arquivo_json, E_USER_ERROR);
    }
}

function dados_do_arquivo_json($nome_arquivo_json) {
    erros($nome_arquivo_json);
    $arquivo_json = $nome_arquivo_json;
    return json_decode(file_get_contents($arquivo_json), true);
}

function salvar_dados_no_arquivo_json($nome_arquivo_json, $dados_a_ser_salvos) {
    erros($nome_arquivo_json);
    $arquivo_json = $nome_arquivo_json;
    file_put_contents($arquivo_json, json_encode($dados_a_ser_salvos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}
?>