<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca CRUD</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background-color: #f0f0f0; }
        h1 { color: #333; }
        .menu { display: flex; flex-direction: column; gap: 10px; margin-top: 20px; }
        a { text-decoration: none; padding: 10px; background-color: #4CAF50; color: white; width: 200px; text-align: center; border-radius: 5px; }
        a:hover { background-color: #45a049; }
        .section { margin-bottom: 30px; }
    </style>
</head>
<body>
    <h1>Biblioteca CRUD</h1>

    <div class="section">
        <h2>Autores</h2>
        <div class="menu">
            <a href="autores/listar.php">Listar Autores</a>
            <a href="autores/criar.php">Cadastrar Autor</a>
        </div>
    </div>

    <div class="section">
        <h2>Livros</h2>
        <div class="menu">
            <a href="livros/listar.php">Listar Livros</a>
            <a href="livros/criar.php">Cadastrar Livro</a>
        </div>
    </div>

    <div class="section">
        <h2>Leitores</h2>
        <div class="menu">
            <a href="leitores/listar.php">Listar Leitores</a>
            <a href="leitores/criar.php">Cadastrar Leitor</a>
        </div>
    </div>

    <div class="section">
        <h2>Empréstimos</h2>
        <div class="menu">
            <a href="emprestimos/listar.php?status=ativos">Empréstimos Ativos</a>
            <a href="emprestimos/listar.php?status=concluidos">Empréstimos Concluídos</a>
            <a href="emprestimos/criar.php">Novo Empréstimo</a>
        </div>
    </div>
</body>
</html>
