<?php
// Página de acervo dos livros com busca
session_start();
$pdo = require_once __DIR__ . '/../includes/bd.php';

if (!($pdo instanceof PDO)) {
    die("Falha na conexão com o banco de dados.");
}

$livros = [];
$termoBusca = '';

// Verifica se há uma busca
if (isset($_GET['busca']) && !empty(trim($_GET['busca']))) {
    $termoBusca = trim($_GET['busca']);
    try {
        $stmt = $pdo->prepare("SELECT id, titulo FROM livros 
                             WHERE titulo LIKE :termo1
                             OR autor LIKE :termo2 
                             OR descricao LIKE :termo3
                             ORDER BY id DESC");

        $termoParam = "%$termoBusca%";
        $stmt->bindParam(':termo1', $termoParam);
        $stmt->bindParam(':termo2', $termoParam);
        $stmt->bindParam(':termo3', $termoParam);

        $stmt->execute();
        $livros = $stmt->fetchAll();

    } 
    catch (PDOException $e) 
    {
        die("Erro ao buscar livros: " . $e->getMessage());
    }
} 
else 
{
    // Se não houver busca, mostra mensagem inicial
    try {
        $stmt = $pdo->query("SELECT id, titulo FROM livros ORDER BY id DESC LIMIT 10");
        $livros = $stmt->fetchAll();
    } catch (PDOException $e) {
        die("Erro ao consultar livros: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libre - Acervo</title>
</head>
<body>
    <h1>Libre</h1>
    
    <div class="search-container">
        <form method="get" action="">
            <input type="text" id="busca" name="busca" 
                   value="<?= htmlspecialchars($termoBusca) ?>" 
                   placeholder="Busque por título, autor ou descrição">
            <button type="submit">Pesquisar</button>
        </form>
    </div>

    <?php if (isset($_GET['busca']) && empty($termoBusca)): ?>
        <p class="no-results">Digite algo para pesquisar...</p>
    
    <?php elseif (!empty($termoBusca) && empty($livros)): ?>
        <p class="no-results">Nenhum livro encontrado com "<?= htmlspecialchars($termoBusca) ?>"</p>
    
    <?php elseif (empty($livros)): ?>
        <p class="no-results">Nada para ver por aqui, faça seu primeiro upload e ele aparecerá aqui!</p>
    
    <?php else: ?>
        <div class="livros-list">
            <?php foreach ($livros as $livro): ?>
                <a href="detalheslivro.php?id=<?= $livro['id'] ?>" class="livro-link">
                    <?= htmlspecialchars($livro['titulo']) ?>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    
    <a href="upload.php" class="upload-btn">Upload</a>
</body>
</html>
