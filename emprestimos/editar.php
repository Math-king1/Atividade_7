<?php
require "../conexao.php";

$id = $_GET['id'];



$stmt = $pdo->prepare("SELECT * FROM emprestimos WHERE id_emprestimo = ?");
$stmt->execute([$id]);
$emprestimo = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$emprestimo) {
    die("Empréstimo não encontrado.");
}



$livros = $pdo->query("SELECT * FROM livros")->fetchAll(PDO::FETCH_ASSOC);
$leitores = $pdo->query("SELECT * FROM leitores")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_livro = $_POST['id_livro'];
    $id_leitor = $_POST['id_leitor'];
    $data_emprestimo = $_POST['data_emprestimo'];
    $data_devolucao = $_POST['data_devolucao'] ?: null;

    
    $stmt = $pdo->prepare("SELECT * FROM emprestimos WHERE id_livro = ? AND data_devolucao IS NULL AND id_emprestimo != ?");
    $stmt->execute([$id_livro, $id]);
    if ($stmt->rowCount() > 0) {
        die("Este livro já está emprestado.");
    }

    
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM emprestimos WHERE id_leitor = ? AND data_devolucao IS NULL AND id_emprestimo != ?");
    $stmt->execute([$id_leitor, $id]);
    if ($stmt->fetchColumn() >= 3) {
        die("O leitor já possui 3 empréstimos ativos.");
    }

    
    if ($data_devolucao && $data_devolucao < $data_emprestimo) {
        die("Data de devolução não pode ser anterior à data de empréstimo.");
    }

   
    $stmt = $pdo->prepare("UPDATE emprestimos SET id_livro = ?, id_leitor = ?, data_emprestimo = ?, data_devolucao = ? WHERE id_emprestimo = ?");
    $stmt->execute([$id_livro, $id_leitor, $data_emprestimo, $data_devolucao, $id]);

    header("Location: listar.php");
}
?>

<form method="POST">
    Livro:
    <select name="id_livro">
        <?php foreach ($livros as $l) : ?>
            <option value="<?= $l['id_livro'] ?>" <?= $l['id_livro'] == $emprestimo['id_livro'] ? 'selected' : '' ?>>
                <?= $l['titulo'] ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    Leitor:
    <select name="id_leitor">
        <?php foreach ($leitores as $l) : ?>
            <option value="<?= $l['id_leitor'] ?>" <?= $l['id_leitor'] == $emprestimo['id_leitor'] ? 'selected' : '' ?>>
                <?= $l['nome'] ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    Data do Empréstimo: <input type="date" name="data_emprestimo" value="<?= $emprestimo['data_emprestimo'] ?>"><br>
    Data de Devolução: <input type="date" name="data_devolucao" value="<?= $emprestimo['data_devolucao'] ?>"><br>

    <button type="submit">Atualizar Empréstimo</button>
</form>
