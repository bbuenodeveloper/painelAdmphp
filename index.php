<?php 
    include ('conexao.php');

    if(isset($_POST['conta']) || isset($_POST['conta'])) {

        if(strlen($_POST['conta']) == 0) {
            echo "Preencha seu usuario";
        } else if (strlen($_POST['senha']) == 0) {
            echo "Preencha sua senha";
        } else {
            
            $conta = $mysqli->real_escape_string($_POST['conta']);
            $senha = $mysqli->real_escape_string($_POST['senha']);

            $sql_code = "SELECT * FROM administrador WHERE conta = '$conta' AND senha = '$senha'";
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
            
            $quatidade = $sql_query->num_rows;

            if($quatidade == 1) {

                $usuario = $sql_query->fetch_assoc();

                if(!isset($_SESSION)) {
                    session_start();
                }

                $_SESSION['id'] = $usuario['id'];
                $_SESSION['nome_completo'] = $usuario['nome_completo'];

                header("Location: painel.php");

            } else {
                echo "Falha ao logar! Usuario ou senha incorretos";
            }
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
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Acesse sua conta</h1>
                <form action="" method="POST">
                    <div>
                        <label>Usuario</label>
                        <input type="text" name="conta" class="form-control">
                    </div>
                    <div>
                        <label>Senha</label>
                        <input type="password" name="senha" class="form-control">
                    </div>
                    <br>
                    <div>
                        <button type="submit" class="btn btn-primary">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>