<?php
    include ('conexao.php');

    if(isset($_POST['cadastrar'])) {

        if(!isset($_SESSION)) {
            session_start();
            
            foreach($_POST as $chave=>$valor) 
                $_SESSION[$chave] = $mysqli->real_escape_string($valor);
            
        }

        if(strlen($_SESSION['nome_fun']) == 0) {
            $erro[] = "Preencha o nome";
        }
        if(strlen($_SESSION['saldo_atual']) == null) {
            $erro[] = "Digite o saldo";
        }
        if(strlen($_SESSION['usuario']) == 0) {
            $erro[] = "Preencha o login";
        }
        if(strlen($_SESSION['senha']) == 0) {
            $erro[] = "Preencha sua senha";
        }

        
            $sql_inserir = "INSERT INTO funcionario ( 
                nome_fun, 
                saldo_atual, 
                usuario, 
                senha)
                VALUES(
                '$_SESSION[nome_fun]',
                '$_SESSION[saldo_atual]',
                '$_SESSION[usuario]',
                '$_SESSION[senha]'
                )";
                $cadastrar = $mysqli->query($sql_inserir) or die($mysqli->error);

                if($cadastrar) {

                    unset($_SESSION['nome_fun'],
                    $_SESSION['saldo_atual'],
                    $_SESSION['usuario'],
                    $_SESSION['senha']);

                    header("Location: painel.php?pagina=1");
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
                <h1>Cadastrar funcionario</h1>
                
                    <form method="POST">
                        <div class="mb-3">
                            <label for="nome_fun" class="form-label">Nome Completo</label>
                            <input type="text" name="nome_fun" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="saldo_atual" class="form-label">Saldo Atual</label>
                            <input type="number" name="saldo_atual" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Login</label>
                            <input type="text" name="usuario" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" name="senha" class="form-control">
                        </div>
                        <button type="submit" value="salvar" name="cadastrar" class="btn btn-success">Cadastrar</button>
                        <a href="painel.php" value="Voltar" name="" class="btn btn-secondary">Voltar</a>
                    </form>
            </div>    
        </div>
    </div>
</body>
</html>