<?php 

    include('protect.php');
    include ('conexao.php');

    $pag = (isset($_GET['pagina'])) ? $_GET['pagina'] :1;
    
    $consulta = "SELECT id, nome_fun, saldo_atual, data_criacao FROM funcionario";
    $con = $mysqli->query($consulta) or die("Falha na execução do código SQL: " . $mysqli->error);

    $itens_paginas = "5";
    $total_rows = $con->num_rows;
    $total_paginas = ceil($total_rows/$itens_paginas);

    $inicio = ($itens_paginas*$pag)-$itens_paginas;
    $limite = $mysqli->query("$consulta LIMIT $inicio, $itens_paginas");

    $anterior = $pag -1;
    $proximo = $pag +1;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Painel</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div>
                    <h5>Bem vindo ao Painel, <?php echo $_SESSION['nome_completo']; ?></h5>
                    <form method="GET" action="busca.php">
                        <input type="text" name="buscar_funcionario" class="form-control" placeholder="Nome Completo">
                        <input type="text" name="buscar_data" class="form-control" placeholder="Data Criação">
                        <br>
                        <button type="submit" value="" name="buscar" class="btn btn-secondary">Buscar</button>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Código</td>
                                <td>Nome Completo</td>
                                <td>Saldo Atual</td>
                                <td>Data Criação</td>
                                <td>Ação</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($dado = $limite->fetch_array()) { ?>
                                <tr>
                                    <td><?php echo $dado["id"]; ?></td>
                                    <td><?php echo $dado["nome_fun"]; ?></td>
                                    <td><?php echo $dado["saldo_atual"]; ?></td>
                                    <td><?php echo date("d/m/Y", strtotime($dado["data_criacao"])); ?></td>
                                    <td><a href="editar.php?codigo=<?php echo $dado["id"]; ?>" class="btn btn-warning">Editar</a>
                                        <a href="javascript: if(confirm('Realmente quer deletar o usuário <?php echo $dado["nome_fun"];  ?>'))
                                        location.href='deletar.php?codigo=<?php echo $dado["id"]; ?>'; " class="btn btn-danger">Excluir</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php 
                                if($pag > 1){
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="painel.php?pagina=<?=$anterior ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <?php } ?>
                            <?php 
                                for($i =1; $i<=$total_paginas; $i++) {
                                    if($pag == $i){
                                        echo "<li class='page-item active'><a class='page-link' href='?pagina=$i'>$i</a></li>";
                                    }else{
                                        echo "<li class='page-item'><a class='page-link' href='?pagina=$i'>$i</a></li>";
                                    }
                                }
                            ?>
                            <?php 
                                if($pag < $total_paginas) {
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="painel.php?pagina=<?=$proximo ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                    </nav>
                </div>
                <div>
                    <a href="cadastrar.php" class="btn btn-success">Cadastrar</a>
                    <a href="movimentacao.php" class="btn btn-info">Movimentação</a>
                    <a href="extrato.php" class="btn btn-secondary">Extrato</a>
                    <a href="logout.php" class="btn btn-secondary">Sair</a>
                </div> 
            </div>
        </div>
    </div> 
</body>
</html>