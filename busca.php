<?php 
    include('protect.php');
    include ('conexao.php');

    $nome_funcionario = $_GET['buscar_funcionario'];
    $data_criacao = $_GET['buscar_data'];
    $mysql_code = "SELECT nome_fun, data_criacao FROM funcionario WHERE nome_fun LIKE '%$nome_funcionario%' OR data_criacao LIKE '%$data_criacao%'";
    $resultado = $mysqli->query($mysql_code) or die($mysqli->error);
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Buscar</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <?php
                    if($resultado !=$_GET){
        
                        while($row = $resultado->fetch_array()) {
                            ?>
                            <tr>
                                <td><?php echo $row["nome_fun"]; ?></td>
                                <td><?php echo date("d/m/Y", strtotime($row["data_criacao"])); ?></td>
                            </tr>
                        <?php } ?>
                        <a href="painel.php" class="btn btn-secondary">Voltar</a>
                <?php
                }else{
                    echo"
                    <script>
                        alert('Não foi possível deletar o usuário');
                            location.href='painel.php';
                    </script>";
                    } 
                ?>
            </div>
        </div>
    </div>
</body>
</html>


