<?php
session_start();
require_once "conexao.php";

if (isset($_POST['email']) && isset($_POST['senha'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuario WHERE email = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "s", $email);
    mysqli_stmt_execute($comando);

    $resultado = mysqli_stmt_get_result($comando);
    $quantidade = mysqli_num_rows($resultado);

    if ($quantidade == 1) {
        $linha = mysqli_fetch_array($resultado);
        $senha_banco = $linha['senha'];

        // Se a senha confere (com hash ou texto puro)
        if ($senha == $senha_banco || password_verify($senha, $senha_banco)) {
            $_SESSION['email'] = $linha['email'];
            $_SESSION['nome'] = $linha['nome'];
            $_SESSION['idusuario'] = $linha['idusuario'];

            // Redireciona para a página principal do sistema hospitalar (CERTO)
            header("Location: principal.php");
            exit();
        } else {
            // Senha incorreta -> vai pro index
            header("Location: index.php?erro=login");
            exit();
        }
    } else {
        // E-mail não encontrado -> vai pro index
        header("Location: index.php?erro=login");
        exit();
    }
}
?>