<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estoque_loja";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Checar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Inserir dados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idMod = $_POST['id_mod'];
    $nome = $_POST['nome'];

    $sql = "INSERT INTO MODELO VALUES ('$idMod','$nome')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Novo Modelo cadastrado com sucesso!";
    } else {
        echo "Erro: " . $conn->error;
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login - Modelo</title>
    <link rel="stylesheet" href="telaCadastros.css">
</head>
<body>
    <form action="telaCadastroModelo.php" method="POST">
        <h2>Tela de Cadastro</h2>
        <label for="id_mod">ID do Modelo:</label>
        <input type="text" id="id_mod" name="id_mod" required>

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <br>
        <a href="index.php">Voltar</a>
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>