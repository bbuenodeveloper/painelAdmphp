<?php
    include ('conexao.php');

    if(isset($_POST['cadastrar_mov'])) {

        if(!isset($_SESSION)) {
            session_start();
            
            foreach($_POST as $chave=>$valor) 
                $_SESSION[$chave] = $mysqli->real_escape_string($valor);
            
        }

        if(strlen($_SESSION['tipo_movimentacao']) == 0) {
            $erro[] = "Preencha o tipo de movimentação";
        }
        if(strlen($_SESSION['valor']) == null) {
            $erro[] = "Digite o valor";
        }
        if(strlen($_SESSION['observacao']) == 0) {
            $erro[] = "Preencha a observação";
        }

        
            $sql_inserir = "INSERT INTO movimentacao ( 
                tipo_movimentacao, 
                valor, 
                observacao)
                VALUES(
                '$_SESSION[tipo_movimentacao]',
                '$_SESSION[valor]',
                '$_SESSION[observacao]'
                )";
                $cadastrar = $mysqli->query($sql_inserir) or die($mysqli->error);

                if($cadastrar) {

                    unset($_SESSION['tipo_movimentacao'],
                    $_SESSION['valor'],
                    $_SESSION['observacao']);

                    header("Location: movimentacao.php?pagina=1");
                }

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
    <title>cadastrar</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Cadastrar Movimentação</h1>
                
                    <form method="POST">
                        <div class="mb-3">
                            <label for="nome_fun" class="form-label">Tipo de Movimentação</label>
                            <input type="text" name="tipo_movimentacao" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="saldo_atual" class="form-label">Valor</label>
                            <input type="number" name="valor" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Observação</label>
                            <input type="text" name="observacao" class="form-control">
                        </div>
                        <button type="submit" value="salvar" name="cadastrar_mov" class="btn btn-success">Cadastrar</button>
                        <a href="movimentacao.php" value="Voltar" name="" class="btn btn-secondary">Voltar</a>
                    </form>
            </div>    
        </div>
    </div>
</body>
</html>