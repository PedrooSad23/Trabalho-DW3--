<?php
require_once "conexao.php";

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

// 1. Processar o upload da foto mantendo o nome original
$foto = "";
if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    // Usa diretamente o nome original do ficheiro enviado
    $nome_arquivo = $_FILES['foto']['name'];
    $caminho_destino = "fotos_user/" . $nome_arquivo;
    
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $caminho_destino)) {
        $foto = $caminho_destino;
    } else {
        header("Location: erro_duplicado.php");
        exit;
    }
} else {
    header("Location: erro_duplicado.php");
    exit;
}

$sql_email = "SELECT idusuario FROM usuario WHERE email = ?";
$stmt = mysqli_prepare($conexao, $sql_email);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$res_email = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($res_email) > 0) {
    header("Location: erro_duplicado.php");
    exit;
}
$sql_user = "INSERT INTO usuario (nome, email, senha, foto) VALUES (?, ?, ?, ?)";
$stmt_user = mysqli_prepare($conexao, $sql_user);
mysqli_stmt_bind_param($stmt_user, "ssss", $nome, $email, $senha, $foto);
mysqli_stmt_execute($stmt_user);

header("Location: index.php");
exit;
?>