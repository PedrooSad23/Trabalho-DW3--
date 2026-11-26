<?php
require_once "../verificar_login.php";
require_once "../conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Consulta</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="container">
        <h2>Agendar Consulta</h2>
        <form action="save_consulta.php" method="post">

            Médico:<br>
            <select name="idmedico" required>
                <option value="">Selecione</option>
                <?php
                $sql = "SELECT idmedico, nome FROM medico";
                $stmt = mysqli_prepare($conexao, $sql);
                mysqli_stmt_execute($stmt);
                $res_medicos = mysqli_stmt_get_result($stmt);
                while ($m = mysqli_fetch_assoc($res_medicos)) {
                    echo "<option value='{$m['idmedico']}'>{$m['nome']}</option>";
                }
                ?>
            </select><br><br>

            Quarto:<br>
            <?php
            $sql = "SELECT idquarto FROM quarto";
            $stmt = mysqli_prepare($conexao, $sql);
            mysqli_stmt_execute($stmt);
            $res_quartos = mysqli_stmt_get_result($stmt);
            while ($q = mysqli_fetch_assoc($res_quartos)) {
                echo "<input type='checkbox' name='idquarto[]' value='{$q['idquarto']}'> Quarto {$q['idquarto']}<br>";
            }
            ?>
            <br>

            Paciente:<br>
            <?php
            $sql = "SELECT idpaciente, nome FROM paciente";
            $stmt = mysqli_prepare($conexao, $sql);
            mysqli_stmt_execute($stmt);
            $res_pacientes = mysqli_stmt_get_result($stmt);
            while ($p = mysqli_fetch_assoc($res_pacientes)) {
                echo "<input type='checkbox' name='idpaciente[]' value='{$p['idpaciente']}'> {$p['nome']}<br>";
            }
            ?>
            <br>

            Data:<br>
            <input type="date" name="data_consulta" required><br><br>

            Horário:<br>
            <input type="time" name="horario" required><br><br>

            <input type="submit" value="Agendar">
        </form>
        <br>
        <a href="../principal.php">Voltar</a>
    </div>
</body>

</html>