<?php 
    include('protect.php');
    include ('conexao.php');

    $usu_codigo = intval($_GET['codigo']);

    $sql_deletar = "DELETE FROM funcionario WHERE funcionario_id = '$usu_codigo'";
    $sql_query = $mysqli->query($sql_deletar) or die($mysqli->error);

    if($sql_query) {
    
    }else{
    echo"
    <script>
        alert('Não foi possível deletar o usuário');
            location.href='painel.php?pagina=0';
    </script>";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Excluir</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Usuário deletado com sucesso</h1>

                <a href="painel.php?pagina=0" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
    </div>
</body>
</html>