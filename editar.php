<?php
    include('protect.php');
    include ('conexao.php');

    if(!isset($_GET['codigo']))
        echo "<script>alert('Codigo invalido.'); location.href='painel.php; </script>";
    
    else {

    $uso_codigo = intval($_GET['codigo']);

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

        
            $sql_inserir = " UPDATE funcionario SET
                nome_fun = '$_SESSION[nome_fun]',
                saldo_atual = '$_SESSION[saldo_atual]', 
                usuario = '$_SESSION[usuario]',
                senha = '$_SESSION[senha]'
                WHERE funcionario_id = '$uso_codigo'";
                $cadastrar = $mysqli->query($sql_inserir) or die($mysqli->error);
                
                header("Location: painel.php?pagina=0");;

        }else {
            $sql_editar = "SELECT * FROM funcionario WHERE funcionario_id = '$uso_codigo'";
            $sql_query = $mysqli->query($sql_editar) or die($mysqli->error);
            $linha = $sql_query->fetch_assoc();
        
            
            if(!isset($_SESSION)) 
                session_start();
        
            $_SESSION['nome_fun'] = $linha['nome_fun'];
            $_SESSION['saldo_atual'] = $linha['saldo_atual'];
            $_SESSION['usuario'] = $linha['usuario'];
            $_SESSION['senha'] = $linha['senha'];
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
    <title>Editar</title>
</head>
<body>
    <h1>Editar funcionario</h1>
    
        <form method="POST">
            <div class="mb-3">
                <label for="nome_fun" class="form-label">Nome Completo</label>
                <input type="text" name="nome_fun" class="form-control" value="<?php echo $_SESSION['nome_fun']; ?>">
            </div>
            <div class="mb-3">
                <label for="saldo_atual" class="form-label">Saldo Atual</label>
                <input type="number" name="saldo_atual" class="form-control" value="<?php echo $_SESSION['saldo_atual']; ?>">
            </div>
            <div class="mb-3">
                <label for="usuario" class="form-label">Login</label>
                <input type="text" name="usuario" class="form-control" value="<?php echo $_SESSION['usuario']; ?>">
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" name="senha" class="form-control" value="<?php echo $_SESSION['senha']; ?>">
            </div>
            <button type="submit" value="salvar" name="cadastrar" class="btn btn-primary">Editar</button>
    </form>

    <?php } ?>

</body>
</html>