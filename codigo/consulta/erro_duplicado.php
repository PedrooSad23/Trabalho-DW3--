<?php
require_once "../verificar_login.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Erro ao Agendar</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <h2>Atenção!</h2>
        <p>Esta consulta já está registada no sistema para este paciente, médico, data e horário.</p>
        <br>
        <a href="form_consulta.php">Voltar ao Formulário</a>
    </div>
</body>
</html>