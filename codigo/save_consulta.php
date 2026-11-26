<?php
require_once "conexao.php";
require_once "verificar_login.php";

$idmedico = $_POST['idmedico'];
$quartos = $_POST['idquarto'];
$pacientes = $_POST['idpaciente'];
$data_consulta = $_POST['data_consulta'];
$horario = $_POST['horario'];
$diagnostico = "Rotina";

$idquarto = $quartos[0];

foreach ($pacientes as $idpaciente) {
    // 1. Verifica se já existe uma consulta igual
    $sql_verifica = "SELECT * FROM consulta WHERE idpaciente = ? AND idmedico = ? AND data_consulta = ? AND horario = ?";
    $stmt_v = mysqli_prepare($conexao, $sql_verifica);
    mysqli_stmt_bind_param($stmt_v, "iiss", $idpaciente, $idmedico, $data_consulta, $horario);
    mysqli_stmt_execute($stmt_v);
    $resultado = mysqli_stmt_get_result($stmt_v);

    // 2. Se JÁ existir, envia para a página de erro e para a execução
    if (mysqli_num_rows($resultado) > 0) {
        header("Location: erro_duplicado.php");
        exit;
    }
}

// 3. Se passar por todos sem duplicar, faz a inserção normalmente
$sql_insert = "INSERT INTO consulta (idpaciente, idmedico, idquarto, data_consulta, horario, diagnostico) VALUES (?, ?, ?, ?, ?, ?)";
$stmt_i = mysqli_prepare($conexao, $sql_insert);

foreach ($pacientes as $idpaciente) {
    mysqli_stmt_bind_param($stmt_i, "iiisss", $idpaciente, $idmedico, $idquarto, $data_consulta, $horario, $diagnostico);
    mysqli_stmt_execute($stmt_i);
}

header("Location: principal.php");
exit;
?>