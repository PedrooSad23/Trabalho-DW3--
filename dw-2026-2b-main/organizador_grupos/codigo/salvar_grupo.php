<?php
session_start();
//pegar o id trabalho
$idtrabalho = $_SESSION['idtrabalho'];

//pegar o nome do grupo
$nome_grupo = $_POST['nome_grupo'];

//pegar os alunos que eu selecionei.
$alunos = $_POST['alunos'];


//gravar o grupo
require_once "conexao.php";

$sql = "INSERT INTO tb_grupo (nome, idtrabalho) VALUES (?, ?)";
$comando = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($comando, "si", $nome_grupo, $idtrabalho);
mysqli_stmt_execute($comando);

//idgrupo que acabou de ser criado/inserido
$idgrupo = mysqli_insert_id($conexao);

// echo $idtrabalho;
// echo "<br>";
// echo $nome_grupo;
// echo "<br>";
// echo "<pre>";
// print_r($alunos);
// echo "</pre>";

//inserir os alunos que eu selecionei
foreach ($alunos as $a) {
    $sql = "INSERT INTO tb_aluno_grupo (idaluno, idgrupo) VALUES (?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "ii", $a, $idgrupo);
    mysqli_stmt_execute($comando);
}
