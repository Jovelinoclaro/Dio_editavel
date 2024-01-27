<?php
include_once "conexao.php";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Lab</title>
</head>

<body>
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-12">
                <div>
                    <h4>DIO TELECOM</h4>
                </div>
            </div>
        </div>
        <hr>

        <!-- SELETOR "msgAlerta" responsável por receber a mensagem de sucesso ou erro -->
        <span id="msgAlerta"></span>

        <div class="row">
            <div class="col-lg-12">
                <!-- SELETOR "listar-usuarios" responsável por receber os registros do banco de dados -->

                <!-- Adiciona a lista de tabelas -->
                <div class="mt-4">
                    <h5>Lista de Tabelas</h5>
                    <?php
                    // Consulta para obter a lista de tabelas no banco de dados
                    $query_tabelas = "SHOW TABLES";
                    $result_tabelas = $conn->prepare($query_tabelas);
                    $result_tabelas->execute();

                    if (($result_tabelas) and ($result_tabelas->rowCount() != 0)) {
                        $tabelas = $result_tabelas->fetchAll(PDO::FETCH_COLUMN);
                        echo "<ul>";
                        foreach ($tabelas as $tabela) {
                            echo "<li>$tabela <button class='btn btn-primary btn-sm' onclick='redirecionarParaPagina(\"$tabela\")'>Ir para Página</button></li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "Nenhuma tabela encontrada!";
                    }
                    ?>
                </div>

                <span class="listar-usuarios"></span>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script src="js/custom.js"></script>
</body>

</html>