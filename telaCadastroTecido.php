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
    $idTec = $_POST['id_tec'];
    $nome = $_POST['nome'];
    $sql = "INSERT INTO TECIDO VALUES ('$idTec','$nome')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Novo tecido cadastrado com sucesso!";
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
    <link rel="stylesheet" href="telaCadastros.css">
    <title>Cadastro de Tecidos</title>
</head>
<body>
    <h2>Cadastro de Tecidos</h2>
    <form action="telaCadastroTecido.php" method="POST">
        <label for="id_tec">Codigo da estampa:</label>
        <input type="text" id="id_tec" name="id_tec" required">
        <label for="nome">Nome do Tecido:</label>
        <input type="text" id="nome" name="nome" required>
        <br><br>
        <a href="index.php">Voltar</a>
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>