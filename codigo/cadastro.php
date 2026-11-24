<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Cadastro</h2>
        <form action="save_cadastro.php" method="post" enctype="multipart/form-data">
            Nome: <br>
            <input type="text" name="nome" required> <br>

            E-mail: <br>
            <input type="text" name="email" required> <br>

            Senha: <br>
            <input type="password" name="senha" required> <br>

            Foto: <br>
            <input type="file" name="foto" required> <br><br>

            Você é?: <br>
            <select name="tipo" required>
                <option value="paciente">Paciente</option>
                <option value="medico">Médico</option>
            </select> <br><br>

            <input type="submit" value="Cadastrar">
        </form>

        <a href="index.php">Já tenho cadastro.</a>
    </div>
</body>
</html>