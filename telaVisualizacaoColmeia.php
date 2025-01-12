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

// Verificar qual botão foi clicado e chamar a função correspondente
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST as $key => $value) {
        if (preg_match('/^[ABCDE]\d+$/', $key)) {
            consultarEstoque($conn, $key);
        }
    }
}

// Função
function consultarEstoque($conn, $codigo) {
    $sql = "SELECT 
                COLMEIA.ID_COD, 
                MODELO.NOME AS NOME_MODELO, 
                TECIDO.NOME AS NOME_TECIDO, 
                COLMEIA.TAMANHO,
                SUM(COLMEIA.QUANT_COD) AS TOTAL_QUANTIDADE
            FROM 
                COLMEIA 
            JOIN 
                MODELO ON COLMEIA.ID_MOD = MODELO.ID_MOD
            JOIN 
                TECIDO ON COLMEIA.ID_TEC = TECIDO.ID_TEC
            WHERE 
                COLMEIA.ID_COD = '$codigo'
            GROUP BY 
                COLMEIA.ID_COD, MODELO.NOME, TECIDO.NOME, COLMEIA.TAMANHO;";

    $result = $conn->query($sql);

    // Verificar se a consulta foi executada corretamente
    if (!$result) {
        die("Erro na consulta: " . $conn->error);
    }

    // Exibir os resultados em tabela
    if ($result->num_rows > 0) {
        echo "<h2>Quantidade Total de $codigo por produto</h2>";
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
}

// Fechar conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="telaVisualizacaoColmeia.css">
    <title>Tabela de Estoque</title>
    
</head>
<body>
    <a href="index.php">Voltar</a>
    <form method="POST">
        <table>
            <tr>
                <th></th>
                <?php for ($i = 1; $i <= 8; $i++) echo "<th>$i</th>"; ?>
            </tr>
            <?php
            $rows = ['A', 'B', 'C', 'D', 'E'];
            foreach ($rows as $row) {
                echo "<tr><th>$row</th>";
                for ($i = 1; $i <= 8; $i++) {
                    echo "<td><button type='submit' name='{$row}{$i}' value='{$row}{$i}'>{$row}{$i}</button></td>";
                }
                echo "</tr>";
            }
            ?>
        </table>
    </form>
</body>
</html>