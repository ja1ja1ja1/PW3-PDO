<!DOCTYPE html>
<html lang="pt-br">
<?php
include 'sistema/configuracao.php';
include 'cabecalho.php';
$span = '<span class="span-aviso" style="display: none;">preencha este campo!</span>';

$pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NOME, DB_USUARIO, DB_SENHA);
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (!empty($_POST['email']) && !empty($_POST['senha'])) {
        try {
            $sql = $pdo->prepare("INSERT INTO usuarios values (null,?,?)");
            $sql->execute(array($_POST['email'], $_POST['senha']));

            $id = $pdo->lastInsertId();

            header('location:pagina.php?id='.$id);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }else if(!empty($_POST['senha']) && $_POST['tipo'] == "update"){
        try {
            $sql = $pdo->prepare("UPDATE usuarios SET senha = ? WHERE id = ".$_GET['id']);
            $sql->execute(array($_POST['senha']));
            header('location:pagina.php?id='.$_POST['id']);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } else {
        $span = '<span class="span-aviso" style="display: block;">email ou senha inválido!</span>';
    }
}




?>

<body>
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/js/script.js" defer></script>
    <?php if (isset($_GET['cad'])) :              ?>
        <div id="cadastro">
            <h3 class="text-center text-white pt-5">cadastro</h3>
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                            <form id="login-form" name="frm" class="form" action="" method="post">
                                <input type="hidden" name="tipo" value="insert">
                                <h3 class="text-center text-info">Cadastro</h3>
                                <div class="form-group">
                                    <label for="email" class="text-info">Email:</label><br>
                                    <input type="text" name="email" id="email" class="form-control" autocomplete="off">
                                    <?php echo $span        ?>
                                </div>
                                <div class="form-group">
                                    <label for="senha" class="text-info">Senha:</label><br>
                                    <input type="text" name="senha" id="senha0" class="form-control" autocomplete="off">
                                    <?php echo $span;        ?>
                                </div>
                                <div class="form-group">
                                    <label for="senha" class="text-info">Confirme a Senha:</label><br>
                                    <input type="text" id="senha1" class="form-control" autocomplete="off">
                                    <?php echo $span;        ?>
                                </div>
                                <div class="form-group">
                                <button id="input-cad" class="btn btn-info btn-md">Cadastrar</button>
                                </div>

                            </form>
                            <div id="register-link" class="text-right">
                                <a href="login.php" class="text-info">Ir para Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php elseif (isset($_GET['att']) && isset($_GET['id'])) :                 ?>
        <div id="cadastro">
            <h3 class="text-center text-white pt-5">Atualizar Senha</h3>
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                            <form id="login-form" name="frm" class="form" action="" method="post">
                                <input type="hidden" name="tipo" value="update">
                                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                                <h3 class="text-center text-info">Atualizar Senha</h3>
                                <div class="form-group">
                                    <label for="senha" class="text-info">Senha:</label><br>
                                    <input type="text" name="senha" id="senha0" class="form-control" autocomplete="off">
                                    <?php echo $span;        ?>
                                </div>
                                <div class="form-group">
                                    <label for="senha" class="text-info">Confirme a Senha:</label><br>
                                    <input type="text" id="senha1" class="form-control" autocomplete="off">
                                    <?php echo $span;        ?>
                                </div>
                                <div class="form-group">
                                    <button id="input-cad" class="btn btn-info btn-md">Atualizar</button>
                                </div>
                                <div id="register-link" class="text-right">
                                    <a href="pagina.php?id=<?php echo $_GET['id'] ?>" class="text-info">Voltar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: 
        header("Location:login.php");
    endif             ?>
</body>

</html>