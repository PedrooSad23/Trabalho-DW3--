<?php
require_once "../conexao.php";
require_once "../verificar_login.php";

$id = $_GET['id'];
$res = mysqli_query($conexao, "SELECT * FROM consulta WHERE idconsulta = $id");
$consulta = mysqli_fetch_assoc($res);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Consulta</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="container">
        <h2>Editar Consulta</h2>
        <form action="save_edit_consulta.php" method="post">
            <input type="hidden" name="idconsulta" value="<?php echo $consulta['idconsulta']; ?>">

            Médico:<br>
            <select name="idmedico" required>
                <?php
                $res_m = mysqli_query($conexao, "SELECT * FROM medico");
                while ($m = mysqli_fetch_assoc($res_m)) {
                    $selected = ($m['idmedico'] == $consulta['idmedico']) ? "selected" : "";
                    echo "<option value='{$m['idmedico']}' $selected>{$m['nome']}</option>";
                }
                ?>
            </select><br><br>

            Quarto:<br>
            <select name="idquarto" required>
                <?php
                $res_q = mysqli_query($conexao, "SELECT * FROM quarto");
                while ($q = mysqli_fetch_assoc($res_q)) {
                    $selected = ($q['idquarto'] == $consulta['idquarto']) ? "selected" : "";
                    echo "<option value='{$q['idquarto']}' $selected>Quarto {$q['idquarto']}</option>";
                }
                ?>
            </select><br><br>

            Paciente:<br>
            <select name="idpaciente" required>
                <?php
                $res_p = mysqli_query($conexao, "SELECT * FROM paciente");
                while ($p = mysqli_fetch_assoc($res_p)) {
                    $selected = ($p['idpaciente'] == $consulta['idpaciente']) ? "selected" : "";
                    echo "<option value='{$p['idpaciente']}' $selected>{$p['nome']}</option>";
                }
                ?>
            </select><br><br>

            Data:<br>
            <input type="date" name="data_consulta" value="<?php echo $consulta['data_consulta']; ?>" required><br><br>

            Horário:<br>
            <input type="time" name="horario" value="<?php echo $consulta['horario']; ?>" required><br><br>

            <input type="submit" value="Atualizar">
        </form>
        <br>
        <a href="listar_consultas.php">Voltar</a>
    </div>
</body>

</html>