<!DOCTYPE html>
<html lang="pt-br">
<?php

include 'cabecalho.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("Location:login.php");
}
?>

<body>
    <div class="container justify-content-center p-5">
        <div class="alert alert-success" role="alert">
            Entrou no Site!!!
        </div>
        <div class="espaco">
            <a href="cadastro.php?att&id=<?php echo $id ?>">Mudar Senha</a>
            <a href="login.php">Sair</a>
        </div>
    </div>

</body>

</html>