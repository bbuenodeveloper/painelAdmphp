<?php 

    include('protect.php');
    include ('conexao.php');

    $pag = (isset($_GET['pagina'])) ? $_GET['pagina'] :1;
    
    $consulta = "SELECT id, tipo_movimentacao, valor, funcionario_id, observacao, dat_criacao FROM movimentacao ORDER BY id DESC";
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
    <title>Movimentação</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div>
                    <h1>Pesquisar Funcionario:</h1>
                    <form method="GET" action="busca_mov.php">
                        <input type="text" name="func_funcionario" class="form-control" placeholder="Nome do Funcionario">
                        <input type="text" name="dat_mov" class="form-control" placeholder="Data Criação">
                        <input type="text" name="tipo_movi" class="form-control" placeholder="Tipo de Movimentação">
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
                                <td>Tipo de Movimentação</td>
                                <td>Valor</td>
                                <td>Data Criação</td>
                                <td> ID Funcionario</td>
                                <td>Observação</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($dado = $limite->fetch_array()) { ?>
                                <tr>
                                    <td><?php echo $dado["id"]; ?></td>
                                    <td><?php echo $dado["tipo_movimentacao"]; ?></td>
                                    <td><?php echo $dado["valor"]; ?></td>
                                    <td><?php echo $dado["funcionario_id"]; ?></td>
                                    <td><?php echo $dado["observacao"]; ?></td>
                                    <td><?php echo date("d/m/Y", strtotime($dado["dat_criacao"])); ?></td>
                                    
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
                                <a class="page-link" href="movimentacao.php?pagina=<?=$anterior ?>" aria-label="Previous">
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
                                <a class="page-link" href="movimentacao.php?pagina=<?=$proximo ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                    </nav>
                </div>
                <div>
                    <a href="cadastrar_mov.php" class="btn btn-success">Cadastrar</a>
                    <a href="painel.php" class="btn btn-secondary">Voltar</a>
                </div> 
            </div>
        </div>
    </div> 
</body>
</html>