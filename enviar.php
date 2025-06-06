<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Proteção básica contra bots
    if (!empty($_POST["telefone"])) {
        exit("Erro no envio.");
    }

    // Receber e sanitizar
    $nome = htmlspecialchars(trim($_POST["nome"] ?? ''));
    $email = filter_var($_POST["email"] ?? '', FILTER_VALIDATE_EMAIL);
    $mensagem = htmlspecialchars(trim($_POST["mensagem"] ?? ''));

    if (!$nome || !$email || !$mensagem) {
        exit("Por favor, preencha todos os campos corretamente.");
    }

    // Configuração
    $para = "ti@samacontabil.com.br";  // Substitua pelo seu e-mail
    $assunto = "Mensagem de $nome pelo site";
    $conteudo = "Nome: $nome\nEmail: $email\n\nMensagem:\n$mensagem";

    // Enviar
    $headers = "From: $email\r\nReply-To: $email\r\nContent-Type: text/plain; charset=UTF-8";

    if (mail($para, $assunto, $conteudo, $headers)) {
        echo "Mensagem enviada com sucesso!";
    } else {
        echo "Erro ao enviar. Tente novamente mais tarde.";
    }
} else {
    echo "Acesso inválido.";
}
?>
