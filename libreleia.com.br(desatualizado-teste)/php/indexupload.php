<?php
require_once __DIR__ . '/../includes/bd.php';
require_once __DIR__ . '/../includes/session.php';

include_once __DIR__ . '/../templates/header.php';

// Consulta os livros
$stmt = $pdo->query("SELECT * FROM livros ORDER BY id DESC");
$livros = $stmt->fetchAll();
?>

<h2>Meus Livros</h2>
<?php if (empty($livros)): ?>
    <p>Nenhum livro enviado ainda.</p>
<?php else: ?>
    <?php foreach ($livros as $livro): ?>
        <div>
            <h3><?= htmlspecialchars($livro['titulo']) ?></h3>
            <p>Autor: <?= htmlspecialchars($livro['autor']) ?></p>
            <p><?= htmlspecialchars($livro['descricao']) ?></p>
            <a href="../<?= $livro['arquivo'] ?>" target="_blank">📥 Baixar</a>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<a href="formupload.php"><button>➕ Enviar novo livro</button></a>

<?php include_once __DIR__ . '/../templates/footer.php'; ?>
