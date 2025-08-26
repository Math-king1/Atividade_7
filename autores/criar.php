<?php
require "../conexao.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $nacionalidade = $_POST['nacionalidade'];
    $ano = $_POST['ano_nascimento'];

    $stmt = $pdo->prepare("INSERT INTO autores (nome, nacionalidade, ano_nascimento) VALUES (?, ?, ?)");
    $stmt->execute([$nome, $nacionalidade, $ano]);

    header("Location: listar.php");
}
?>

<form method="POST">
    Nome: <input type="text" name="nome" required><br>
    Nacionalidade: <input type="text" name="nacionalidade"><br>
    Ano de Nascimento: <input type="number" name="ano_nascimento"><br>
    <button type="submit">Salvar</button>
</form>
