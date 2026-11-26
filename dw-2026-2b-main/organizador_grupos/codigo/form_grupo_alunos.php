<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Grupos - Passo 2</title>
</head>

<body>
    <form action="form_grupo_alunos.php" method="post">
        <h1>Cadastro de Grupos - Passo 2</h1>

        Escolha uma turma: <br>
        <select name="turma">
            <?php
            require_once "conexao.php";

            $sql = "SELECT * FROM tb_turma";

            $comando = mysqli_prepare($conexao, $sql);
            mysqli_stmt_execute($comando);
            $turmas = mysqli_stmt_get_result($comando);

            while ($turma = mysqli_fetch_array($turmas)) {
                $turma_id = $turma['idturma'];
                $turma_nome = $turma['nome'];

                echo "<option value='$turma_id'>$turma_nome</option>";
            }
            ?>
        </select> <br><br>

        <input type="submit" value="Avançar">
    </form>


    <?php
    if (isset($_POST['turma'])) {
        $idtrabalho = $_SESSION['idtrabalho'];
        $idturma = $_POST['turma'];

        $sql = "SELECT * FROM tb_aluno WHERE idturma = ?";
        // require_once "conexao.php";
        $comando = mysqli_prepare($conexao, $sql);

        mysqli_stmt_bind_param($comando, "i", $idturma);
        mysqli_stmt_execute($comando);
        $alunos = mysqli_stmt_get_result($comando);

    ?>
        <h2>Lista de Alunos</h2>
        <form action="salvar_grupo.php" method="post">
            Nome do grupo: <br>
            <input type="text" name="nome_grupo"> <br><br>

            <?php
            while ($aluno = mysqli_fetch_array($alunos)) {
                $id_aluno = $aluno['idaluno'];
                $nome_aluno = $aluno['nome'];
            ?>
                <input type="checkbox" name="alunos[]" value="<?php echo $id_aluno; ?>"> <?php echo $nome_aluno; ?> <br>
        <?php
            }
        }
        ?>
        <br>
        <input type="submit" value="Salvar Grupo">
        </form>
</body>

</html>
