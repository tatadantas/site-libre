<?php
session_start();

// Inclui o arquivo de conexão e captura o retorno
$pdo = require_once __DIR__ . '/../includes/bd.php';

// Verificação adicional de conexão
if (!($pdo instanceof PDO)) {
    die("Falha na conexão com o banco de dados.");
}

try {
    // Consulta os livros
    $stmt = $pdo->query("SELECT * FROM livros ORDER BY id DESC");
    $livros = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Erro ao consultar livros: " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Plataforma de Livros</title>
</head>
<body>
    <!-- Restante do seu HTML permanece igual -->
    <?php if (empty($livros)): ?>
        <p>Nada para ver por aqui, faça seu primeiro upload e ele aparecerá aqui!</p>
    <?php else: ?>
        <?php foreach ($livros as $livro): ?>
            <div>
                <h2><?= htmlspecialchars($livro['titulo']) ?></h2>
                <p>Autor: <?= htmlspecialchars($livro['autor']) ?></p>
                <p><?= htmlspecialchars($livro['descricao']) ?></p>
                <a href="download.php?id=<?= $livro['id'] ?>" target="_blank">Baixar arquivo</a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    
    <a href="formupload.php"><button>Upload</button></a>
</body>
</html>