<?php
header('Content-Type: text/plain; charset=utf-8'); // Define o tipo de conteúdo para texto puro

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeGuerra = filter_input(INPUT_POST, 'nome_guerra', FILTER_SANITIZE_STRING);
    $emailGuerra = filter_input(INPUT_POST, 'email_guerra', FILTER_SANITIZE_EMAIL);

    if ($nomeGuerra && $emailGuerra) {
        $data = "[" . date("Y-m-d H:i:s") . "] Nome de Guerra: " . $nomeGuerra . ", Email: " . $emailGuerra . "\n";
        $arquivo = 'inscricoes.txt';

        if (file_put_contents($arquivo, $data, FILE_APPEND | LOCK_EX) !== false) {
            echo "Sucesso: Seus dados foram registrados. Aguarde as próximas instruções.";
        } else {
            http_response_code(500); // Internal Server Error
            echo "Erro: Não foi possível registrar seus dados. Tente novamente mais tarde.";
        }
    } else {
        http_response_code(400); // Bad Request
        echo "Erro: Nome de guerra ou email inválidos.";
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo "Erro: Método de requisição não permitido.";
}
?>