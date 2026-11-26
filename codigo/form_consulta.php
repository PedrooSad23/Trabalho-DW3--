<?php
require_once "conexao.php";
require_once "verificar_login.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Consulta</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form action="save_consulta.php" method="post">
        <h1>Cadastro de Consulta</h1>

        Escolha um médico: <br>
        <select name="idmedico" required>
            <option value="">-- Selecione --</option>
            <?php
            $sql = "SELECT * FROM medico";
            $comando = mysqli_prepare($conexao, $sql);
            mysqli_stmt_execute($comando);
            $medicos = mysqli_stmt_get_result($comando);

            while ($medico = mysqli_fetch_array($medicos)) {
                $medico_id = $medico['idmedico'];
                $medico_nome = $medico['nome'];

                echo "<option value='$medico_id'>$medico_nome</option>";
            }
            ?>
        </select> <br><br>

        Escolha o Paciente: <br>
        <?php
        $sql = "SELECT * FROM paciente";
        $comando = mysqli_prepare($conexao, $sql);
        mysqli_stmt_execute($comando);
        $pacientes = mysqli_stmt_get_result($comando);

        while ($paciente = mysqli_fetch_array($pacientes)) {
            $paciente_id = $paciente['idpaciente'];
            $paciente_nome = $paciente['nome'];

            echo "<input type='checkbox' name='idpaciente[]' value='$paciente_id'> $paciente_nome <br>";
        }
        ?>
        <br>

        Data e Hora: <br>
        <input type="datetime-local" name="data_consulta" required> <br><br>

        <input type="submit" value="Agendar Consulta">
    </form>
    
    <br>
    <a href="principal.php">Voltar à Página Principal</a>
</body>

</html>