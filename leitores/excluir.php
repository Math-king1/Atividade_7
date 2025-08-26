<?php
require "../conexao.php";

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM leitores WHERE id_leitor = ?");
$stmt->execute([$id]);

header("Location: listar.php");
