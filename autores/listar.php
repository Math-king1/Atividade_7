<?php
require "../conexao.php";

$filtro = $_GET['filtro'] ?? '';

if ($filtro) {
    $stmt = $pdo->prepare("SELECT * FROM autores WHERE nome LIKE ?");
    $stmt->execute(["%$filtro%"]);
} else {
    $stmt = $pdo->query("SELECT * FROM autores");
}

$autores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<form method="GET">
    Filtrar por nome: <input type="text" name="filtro">
    <button type="submit">Filtrar</button>
</form>

<table border="1">
    <tr><th>ID</th><th>Nome</th><th>Nacionalidade</th><th>Ano Nasc.</th><th>Ações</th></tr>
    <?php foreach($autores as $a): ?>
    <tr>
        <td><?= $a['id_autor'] ?></td>
        <td><?= $a['nome'] ?></td>
        <td><?= $a['nacionalidade'] ?></td>
        <td><?= $a['ano_nascimento'] ?></td>
        <td>
            <a href="editar.php?id=<?= $a['id_autor'] ?>">Editar</a> | 
            <a href="excluir.php?id=<?= $a['id_autor'] ?>">Excluir</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
