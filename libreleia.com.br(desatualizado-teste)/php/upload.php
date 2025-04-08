<?php
require_once __DIR__ . '/../includes/bd.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/session.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit("Método não permitido.");
}

// Diretório de upload
$uploadDir = __DIR__ . '/../uploads/livros/';
if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);

// Verifica extensão
$ext = strtolower(pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION));
if (!in_array($ext, ['pdf', 'epub'])) exit("Apenas PDF e EPUB permitidos.");

// Gera nome seguro
$nomeLimpo = preg_replace('/[^\w\.-]/', '_', $_FILES['arquivo']['name']);
$novoNome = uniqid() . '_' . $nomeLimpo;
$caminhoCompleto = $uploadDir . $novoNome;
$caminhoRelativo = 'uploads/livros/' . $novoNome;

if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminhoCompleto)) {
    $titulo = $_POST['titulo'] ?? 'Sem título';
    $autor = $_POST['autor'] ?: '@' . $_SESSION['usuario'];
    $descricao = $_POST['descricao'] ?? '';

    try {
        cadastrarLivro($titulo, $autor, $descricao, $caminhoRelativo, $pdo);
        header('Location: indexupload.php');
        exit;
    } catch (PDOException $e) {
        unlink($caminhoCompleto);
        exit("Erro no banco: " . $e->getMessage());
    }
} else {
    exit("Falha ao mover o arquivo.");
}
