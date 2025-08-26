<?php
require "../conexao.php";


$status = $_GET['status'] ?? 'ativos';

if ($status === 'concluidos') {
    $stmt = $pdo->query("SELECT e.*, l.titulo, le.nome as leitor 
                         FROM emprestimos e 
                         JOIN livros l ON e.id_livro = l.id_livro 
                         JOIN leitores le ON e.id_leitor = le.id_leitor 
                         WHERE e.data_devolucao IS NOT NULL");
} else {
    $stmt = $pdo->query("SELECT e.*, l.titulo, le.nome as leitor 
                         FROM emprestimos e 
                         JOIN livros l ON e.id_livro = l.id_livro 
                         JOIN leitores le ON e.id_leitor = le.id_leitor 
                         WHERE e.data_devolucao IS NULL");
}

$emprestimos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<a href="listar.php?status=ativos">Ativos</a> | 
<a href="listar.php?status=concluidos">Concluídos</a> | 
<a href="criar.php">Novo Empréstimo</a>

<table border="1">
<tr><th>ID</th><th>Livro</th><th>Leitor</th><th>Data Empréstimo</th><th>Data Devolução</th><th>Ações</th></tr>
<?php foreach ($emprestimos as $e) : ?>
<tr>
    <td><?= $e['id_emprestimo'] ?></td>
    <td><?= $e['titulo'] ?></td>
    <td><?= $e['leitor'] ?></td>
    <td><?= $e['data_emprestimo'] ?></td>
    <td><?= $e['data_devolucao'] ?? '-' ?></td>
    <td>
        <?php if (!$e['data_devolucao']): ?>
            <a href="devolver.php?id=<?= $e['id_emprestimo'] ?>">Devolver</a>
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>
</table>
