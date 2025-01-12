<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "estoque_loja";

    // Conectar ao banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Checar conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Consulta SQL para somar as quantidades de registros duplicados
    $sql = "
    SELECT 
        MODELO.NOME AS NOME_MODELO, 
        TECIDO.NOME AS NOME_TECIDO,
        ESTOQUE.TAMANHO, 
        SUM(ESTOQUE.QUANT_ESTOQUE) AS TOTAL_QUANTIDADE
    FROM ESTOQUE
    JOIN MODELO ON ESTOQUE.ID_MOD = MODELO.ID_MOD
    JOIN TECIDO ON ESTOQUE.ID_TEC = TECIDO.ID_TEC
    GROUP BY MODELO.NOME, TECIDO.NOME, ESTOQUE.TAMANHO
    ";

    $result = $conn->query($sql);

    // Exibir os resultados em tabela
    if ($result->num_rows > 0) {
        echo "<h2>Quantidade Total por Produto</h2>";
        echo "<table border='1'>
                <tr>
                    <th>Nome do Modelo</th>
                    <th>Nome do Tecido</th>
                    <th>Tamanho</th>
                    <th>Quantidade</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['NOME_MODELO']}</td>
                    <td>{$row['NOME_TECIDO']}</td>
                    <td>{$row['TAMANHO']}</td>
                    <td>{$row['TOTAL_QUANTIDADE']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "Nenhum registro encontrado.";
    }

    // Fechar conexão
    $conn->close();
    ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="telaVisualizacaoEstoque.css">
</head>
<body>
    <a href="index.php">Voltar</a>
</body>
</html>
