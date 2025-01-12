<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estoque_loja";

// Criar conexão segura usando mysqli
$conn = new mysqli($servername, $username, $password, $dbname);

// Checar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Inserir dados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idMod = htmlspecialchars($_POST['id_mod']);
    $idTec = htmlspecialchars($_POST['id_tec']);
    $tamanho = htmlspecialchars($_POST['tamanho']);
    $quant = $_POST['quant'];
    

        // Usando prepared statement para segurança contra SQL Injection
        $stmt = $conn->prepare("INSERT INTO ESTOQUE (ID_MOD, ID_TEC, TAMANHO, QUANT_ESTOQUE) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sisi", $idMod, $idTec, $tamanho, $quant);

        if ($stmt->execute()) {
            echo "Novo tecido cadastrado com sucesso!";
        } else {
            echo "Erro: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Por obséquio, preencha todos os campos corretamente.";
    }
    $conn->close();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="telaCadastros.css">
    <title>Cadastro de Estoque</title>
</head>
<body>
    <h2>Cadastro de Estoque</h2>
    <form action="telaCadastroEstoque.php" method="POST">

        <label for="id_mod">ID do Modelo:</label>
        <input type="text" id="id_mod" name="id_mod" required>

        <label for="id_tec">Código da estampa:</label>
        <input type="text" id="id_tec" name="id_tec" required>

        <label for="tamanho">Tamanho:</label>
        <input type="text" id="tamanho" name="tamanho" required>

        <label for="quant">Quantidade:</label>
        <input type="text" id="quant" name="quant" required>

        <br><br>
        <a href="index.php">Voltar</a>
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>