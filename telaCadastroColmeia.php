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
    $idColmeia = $_POST['colmeia'];
    $idMod = $_POST['id_mod'];
    $idTec = $_POST['id_tec'];
    $tamanho = $_POST['tamanho'];
    $quant = $_POST['quant'];

    // Usando prepared statement corretamente com bind_param
    $stmt = $conn->prepare("INSERT INTO COLMEIA (ID_COD, ID_MOD, TAMANHO, ID_TEC, QUANT_COD) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $idColmeia, $idMod, $tamanho, $idTec, $quant);

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
    <title>Cadastro de Colmeia</title>
</head>
<body>
    <h2>Cadastro de Colmeia</h2>
    <form action="telaCadastroColmeia.php" method="POST">
        <label for="colmeia">Colmeia</label>
        <select id="colmeia" name="colmeia">
            <option value="A1">A1</option>
            <option value="A2">A2</option>
            <option value="A3">A3</option>
            <option value="A4">A4</option>
            <option value="A5">A5</option>
            <option value="A6">A6</option>
            <option value="A7">A7</option>
            <option value="A8">A8</option>
            <option value="B1">B1</option>
            <option value="B2">B2</option>
            <option value="B3">B3</option>
            <option value="B4">B4</option>
            <option value="B5">B5</option>
            <option value="B6">B6</option>
            <option value="B7">B7</option>
            <option value="B8">B8</option>
            <option value="C1">C1</option>
            <option value="C2">C2</option>
            <option value="C3">C3</option>
            <option value="C4">C4</option>
            <option value="C5">C5</option>
            <option value="C6">C6</option>
            <option value="C7">C7</option>
            <option value="C8">C8</option>
            <option value="D1">D1</option>
            <option value="D2">D2</option>
            <option value="D3">D3</option>
            <option value="D4">D4</option>
            <option value="D5">D5</option>
            <option value="D6">D6</option>
            <option value="D7">D7</option>
            <option value="D8">D8</option>
            <option value="E1">E1</option>
            <option value="E2">E2</option>
            <option value="E3">E3</option>
            <option value="E4">E4</option>
            <option value="E5">E5</option>
            <option value="E6">E6</option>
            <option value="E7">E7</option>
            <option value="E8">E8</option>
        </select><br>

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
