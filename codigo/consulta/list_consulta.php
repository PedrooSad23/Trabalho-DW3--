<?php
require_once "../conexao.php";
require_once "../verificar_login.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Listar Consultas</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="container">
        <h2>Lista de Consultas</h2>

        <table>
            <tr>
                <th>Médico</th>
                <th>Paciente</th>
                <th>Quarto</th>
                <th>Data / Hora</th>
                <th>Ações</th>
            </tr>
            <?php
            $sql = "SELECT c.idconsulta, m.nome as medico, p.nome as paciente, q.idquarto, c.data_consulta, c.horario 
                    FROM consulta c, medico m, paciente p, quarto q 
                    WHERE c.idmedico = m.idmedico 
                      AND c.idpaciente = p.idpaciente 
                      AND c.idquarto = q.idquarto";
            $res = mysqli_query($conexao, $sql);

            while ($c = mysqli_fetch_assoc($res)) {
                echo "<tr>";
                echo "<td>{$c['medico']}</td>";
                echo "<td>{$c['paciente']}</td>";
                echo "<td>Q. {$c['idquarto']}</td>";
                echo "<td>{$c['data_consulta']} {$c['horario']}</td>";
                echo "<td>
                        <a href='editar_consulta.php?id={$c['idconsulta']}'>Editar</a> | 
                        <a href='deletar_consulta.php?id={$c['idconsulta']}' onclick='return confirm(\"Tens a certeza que queres apagar?\")'>Excluir</a>
                      </td>";
                echo "</tr>";
            }
            ?>
        </table>

        <a href="form_consulta.php">Nova Consulta</a> |
        <a href="principal.php">Voltar</a>
    </div>
</body>

</html>