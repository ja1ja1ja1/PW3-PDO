
<?php


include 'vendor/autoload.php';
include 'cabecalho.php';
use sistema\Modelo\Crud;


$span = '<span class="span-aviso" style="display: none;">preencha este campo!</span>';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
$email = $_POST['email'];
$senha = $_POST['senha'];
    if (!empty(trim($email)) && !empty(trim($senha))) {
        try {
            // Recupere os dados do usuário
            $usuario = (new Crud())->buscaEmailSenha($email,$senha);
    
            if ($usuario) {
                // Redirecione para a página com o ID do usuário
                header('Location: pagina.php?id=' . $usuario->id);
                exit(); // Certifique-se de sair após o redirecionamento
            } else {
                $span = '<span class="span-aviso" style="display: block;">Email ou senha inválido!</span>';
            }
        } catch (PDOException $e) {
            // Trate os erros da consulta SQL aqui
            echo 'Erro na consulta SQL: ' . $e->getMessage();
        }
    } else {
        $span = '<span class="span-aviso" style="display: block;">email ou senha inválido!</span>';
    }
}
?>
<body>
<div id="login">
        <h3 class="text-center text-white pt-5">Login form</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <input type="hidden" name="tipo" value="select">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="email" class="text-info">Email:</label><br>
                                <input type="text" name="email" id="email" class="form-control" autocomplete="off">
                                <?php    echo $span;        ?>
                            </div>
                            <div class="form-group">
                                <label for="senha" class="text-info">Senha:</label><br>
                                <input type="text" name="senha" id="senha" class="form-control" autocomplete="off">
                                <span class="span-aviso" style="display: none;">preencha sua senha!</span>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Entrar">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="cadastro.php?cad" class="text-info">Cadastrar-se</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>