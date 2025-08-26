<?php
require "../conexao.php";

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM emprestimos WHERE id_emprestimo = ?");
$stmt->execute([$id]);
$emprestimo = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data_devolucao = $_POST['data_devolucao'];
    if ($data_devolucao < $emprestimo['data_emprestimo']) {
        die("Data de devolução não pode ser anterior à data de empréstimo.");
    }
    $stmt = $pdo->prepare("UPDATE emprestimos SET data_devolucao = ? WHERE id_emprestimo = ?");
    $stmt->execute([$data_devolucao, $id]);
    header("Location: listar.php");
}
?>

<form method="POST">
    Data do Empréstimo: <?= $emprestimo['data_emprestimo'] ?><br>
    Data de Devolução: <input type="date" name="data_devolucao" value="<?= date('Y-m-d') ?>"><br>
    <button type="submit">Registrar Devolução</button>
</form>
