<?php
require_once __DIR__ . '/../includes/bd.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("HTTP/1.0 405 Method Not Allowed");
    die("Método não permitido.");
}

// Configurações de upload (AJUSTE PARA SEU AMBIENTE)
$baseDir = 'C:/wamp64/www/logincad';
$uploadDir = $baseDir . '/uploads/livros/';

// Criar diretório se não existir
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Processamento do arquivo
$fileType = strtolower(pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION));
if (!in_array($fileType, ['pdf', 'epub'])) {
    die("Apenas arquivos PDF e EPUB são permitidos.");
}

// Gerar nome único para o arquivo
$uniqueId = uniqid();
$safeName = preg_replace('/[^\w\.-]/', '_', $_FILES['arquivo']['name']);
$fileName = $uniqueId . '_' . $safeName;
$targetFile = $uploadDir . $fileName;

if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $targetFile)) {
    // Salvar no banco o caminho relativo CORRETO
    $relativePath = 'uploads/livros/' . $fileName;
    
    try {
        $stmt = $pdo->prepare("INSERT INTO livros (titulo, autor, descricao, arquivo) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $_POST['titulo'],
            $_POST['autor'] ?? '@' . $_SESSION['usuario'],
            $_POST['descricao'] ?? '',
            $relativePath
        ]);
        
        header("Location: ../pages/indexupload.php");
        exit;
    } catch (PDOException $e) {
        unlink($targetFile); // Remove o arquivo se falhar no BD
        die("Erro ao salvar no banco de dados: " . $e->getMessage());
    }
} else {
    die("Erro ao mover o arquivo. Verifique permissões.");
}   
?>