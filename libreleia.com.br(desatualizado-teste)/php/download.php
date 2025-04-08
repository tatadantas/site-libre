<?php
require_once __DIR__ . '/../includes/bd.php';

// Verificação rigorosa do ID
if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    header("HTTP/1.0 400 Bad Request");
    die("ID do livro inválido.");
}

try {
    // Consulta ao banco de dados
    $stmt = $pdo->prepare("SELECT arquivo, titulo FROM livros WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $livro = $stmt->fetch();
    
    if (!$livro) {
        header("HTTP/1.0 404 Not Found");
        die("Livro não encontrado no banco de dados.");
    }

    // Caminho base absoluto (AJUSTE PARA SEU AMBIENTE)
    $basePath = 'C:/wamp64/www/logincad';
    
    // Construção do caminho completo
    $relativePath = ltrim(str_replace('\\', '/', $livro['arquivo']), '/');
    $filePath = realpath($basePath . '/' . $relativePath);
    
    // Verificação EXTRA de segurança e existência
    if (!$filePath || !file_exists($filePath)) {
        // Tentativa alternativa para nomes com espaços
        $altPath = $basePath . '/' . str_replace(' ', '%20', $relativePath);
        if (!file_exists($altPath)) {
            // Log detalhado para diagnóstico
            error_log("Arquivo não encontrado. Caminhos testados:\n" .
                     "- Original: " . $basePath . '/' . $relativePath . "\n" .
                     "- Alternativo: " . $altPath);
            
            header("HTTP/1.0 404 Not Found");
            die("Arquivo não encontrado no servidor. Código: DL404");
        }
        $filePath = $altPath;
    }

    // Configuração do download
    $safeFilename = preg_replace('/[^\w\.-]/', '_', $livro['titulo']) . '.' . pathinfo($filePath, PATHINFO_EXTENSION);
    
    // Headers para forçar download
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $safeFilename . '"');
    header('Content-Length: ' . filesize($filePath));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');

    // Limpeza de buffer e envio do arquivo
    ob_clean();
    flush();
    readfile($filePath);
    exit;

} catch (PDOException $e) {
    error_log("Erro no banco de dados: " . $e->getMessage());
    header("HTTP/1.0 500 Internal Server Error");
    die("Erro no servidor. Código: DL500");
}
?>