<?php
require "../conexao.php";

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM leitores WHERE id_leitor = ?");
$stmt->execute([$id]);
$leitor = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    $stmt = $pdo->prepare("UPDATE leitores SET nome = ?, email = ?, telefone = ? WHERE id_leitor = ?");
    $stmt->execute([$nome, $email, $telefone, $id]);

    header("Location: listar.php");
}
?>

<form method="POST">
    Nome: <input type="text" name="nome" value="<?= $leitor['nome'] ?>" required><br>
    Email: <input type="email" name="email" value="<?= $leitor['email'] ?>" required><br>
    Telefone: <input type="text" name="telefone" value="<?= $leitor['telefone'] ?>"><br>
    <button type="submit">Atualizar</button>
</form>
