<?php
require "../conexao.php";

$filtro = $_GET['filtro'] ?? '';

if ($filtro) {
    $stmt = $pdo->prepare("SELECT * FROM leitores WHERE nome LIKE ?");
    $stmt->execute(["%$filtro%"]);
} else {
    $stmt = $pdo->query("SELECT * FROM leitores");
}

$leitores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<a href="criar.php">Novo Leitor</a>

<form method="GET">
    Filtrar por nome: <input type="text" name="filtro">
    <button type="submit">Filtrar</button>
</form>

<table border="1">
<tr><th>ID</th><th>Nome</th><th>Email</th><th>Telefone</th><th>Ações</th></tr>
<?php foreach($leitores as $l): ?>
<tr>
    <td><?= $l['id_leitor'] ?></td>
    <td><?= $l['nome'] ?></td>
    <td><?= $l['email'] ?></td>
    <td><?= $l['telefone'] ?></td>
    <td>
        <a href="editar.php?id=<?= $l['id_leitor'] ?>">Editar</a> | 
        <a href="excluir.php?id=<?= $l['id_leitor'] ?>">Excluir</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
