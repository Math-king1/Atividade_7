<?php
require "../conexao.php";


$livros = $pdo->query("SELECT * FROM livros")->fetchAll(PDO::FETCH_ASSOC);
$leitores = $pdo->query("SELECT * FROM leitores")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_livro = $_POST['id_livro'];
    $id_leitor = $_POST['id_leitor'];
    $data_emprestimo = $_POST['data_emprestimo'];

    
    $stmt = $pdo->prepare("SELECT * FROM emprestimos WHERE id_livro = ? AND data_devolucao IS NULL");
    $stmt->execute([$id_livro]);
    if ($stmt->rowCount() > 0) {
        die("Este livro já está emprestado.");
    }

  
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM emprestimos WHERE id_leitor = ? AND data_devolucao IS NULL");
    $stmt->execute([$id_leitor]);
    if ($stmt->fetchColumn() >= 3) {
        die("O leitor já possui 3 empréstimos ativos.");
    }


    $stmt = $pdo->prepare("INSERT INTO emprestimos (id_livro, id_leitor, data_emprestimo) VALUES (?, ?, ?)");
    $stmt->execute([$id_livro, $id_leitor, $data_emprestimo]);

    header("Location: listar.php");
}
?>

<form method="POST">
    Livro:
    <select name="id_livro">
        <?php foreach ($livros as $l) : ?>
            <option value="<?= $l['id_livro'] ?>"><?= $l['titulo'] ?></option>
        <?php endforeach; ?>
    </select><br>

    Leitor:
    <select name="id_leitor">
        <?php foreach ($leitores as $l) : ?>
            <option value="<?= $l['id_leitor'] ?>"><?= $l['nome'] ?></option>
        <?php endforeach; ?>
    </select><br>

    Data do Empréstimo: <input type="date" name="data_emprestimo" value="<?= date('Y-m-d') ?>"><br>
    <button type="submit">Emprestar</button>
</form>
