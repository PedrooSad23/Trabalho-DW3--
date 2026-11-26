<?php
require_once "../conexao.php";
require_once "../verificar_login.php";

$idconsulta = $_POST['idconsulta'];
$idmedico = $_POST['idmedico'];
$idquarto = $_POST['idquarto'];
$idpaciente = $_POST['idpaciente'];
$data_consulta = $_POST['data_consulta'];
$horario = $_POST['horario'];

$sql = "UPDATE consulta SET idmedico = ?, idquarto = ?, idpaciente = ?, data_consulta = ?, horario = ? WHERE idconsulta = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "iiissi", $idmedico, $idquarto, $idpaciente, $data_consulta, $horario, $idconsulta);
mysqli_stmt_execute($stmt);

header("Location: list_consulta.php");
exit;
