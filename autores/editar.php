<?php
require "../conexao.php";

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM autores WHERE id_autor = ?");
$stmt->execute([$id]);
$autor = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $nacionalidade = $_POST['nacionalidade'];
    $ano = $_POST['ano_nascimento'];

    $stmt = $pdo->prepare("UPDATE autores SET nome = ?, nacionalidade = ?, ano_nascimento = ? WHERE id_autor = ?");
    $stmt->execute([$nome, $nacionalidade, $ano, $id]);

    header("Location: listar.php");
}
?>

<form method="POST">
    Nome: <input type="text" name="nome" value="<?= $autor['nome'] ?>" required><br>
    Nacionalidade: <input type="text" name="nacionalidade" value="<?= $autor['nacionalidade'] ?>"><br>
    Ano de Nascimento: <input type="number" name="ano_nascimento" value="<?= $autor['ano_nascimento'] ?>"><br>
    <button type="submit">Atualizar</button>
</form>
