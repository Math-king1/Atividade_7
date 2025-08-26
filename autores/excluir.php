<?php
require "../conexao.php";

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM autores WHERE id_autor = ?");
$stmt->execute([$id]);

header("Location: listar.php");
