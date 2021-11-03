<?php 

    include('protect.php');
    include ('conexao.php');

    $consulta = "SELECT id, dat_criacao, tipo_movimentacao, valor, observacao FROM movimentacao";
    $con = $mysqli->query($consulta) or die("Falha na execução do código SQL: " . $mysqli->error);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Extrato</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div>
                    <h1>Extrato</h1>
                </div>
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Código</td>
                                <td>Data Criação</td>
                                <td>Tipo Movimentacao</td>
                                <td>Valor</td>
                                <td>Observação</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($dado = $con->fetch_array()) { ?>
                                <tr>
                                    <td><?php echo $dado["id"]; ?></td>
                                    <td><?php echo date("d/m/Y", strtotime($dado["dat_criacao"])); ?></td>
                                    <td><?php echo $dado["tipo_movimentacao"]; ?></td>
                                    <td><?php echo $dado["valor"]; ?></td>  
                                    <td><?php echo $dado["observacao"]; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div>
                    <a href="painel.php" class="btn btn-secondary">Voltar</a>
                </div> 
            </div>
        </div>
    </div> 
</body>
</html>