<?php
session_start();
require_once __DIR__ . '/../includes/bd.php'; // conexão com BD

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['email'])) {
    echo json_encode(["sucesso" => false, "mensagem" => "Dados inválidos"]);
    exit;
}

$email = $data['email'];
$nome = $data['nome'];
$google_id = $data['google_id'];

try {
    // Verifica se já existe usuário com esse email
    $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE email_cadastro = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    if ($usuario) {
        // Login direto
        $_SESSION['user_id'] = $usuario['id_cadastro'];
        $_SESSION['user_name'] = $usuario['nome_cadastro'];
        $_SESSION['username'] = $usuario['username_cadastro']; // caso exista

    } else {
        // Criar usuário novo
        $stmt = $conexao->prepare("INSERT INTO usuarios (nome_cadastro, email_cadastro, senha_cadastro, username_cadastro) VALUES (?, ?, ?, ?)");
        $username_gerado = explode("@", $email)[0] . rand(1000, 9999); // gerar username simples
        $senha_fake = password_hash(uniqid(), PASSWORD_DEFAULT); // senha aleatória só pra preencher
        $stmt->execute([$nome, $email, $senha_fake, $username_gerado]);

        $id = $conexao->lastInsertId();
        $_SESSION['user_id'] = $id;
        $_SESSION['user_name'] = $nome;
        $_SESSION['username'] = $username_gerado;
    }

    echo json_encode(["sucesso" => true]);

} catch (PDOException $e) {
    error_log("ERRO GOOGLE LOGIN: " . $e->getMessage());
    echo json_encode(["sucesso" => false, "mensagem" => "Erro no login"]);
}
