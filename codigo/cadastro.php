<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Registar Utilizador</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container" style="width: 300px;">
        <h2>Registar Utilizador</h2>
        <!-- ATENÇÃO AO enctype="multipart/form-data" para aceitar arquivos -->
        <form action="save_cadastro.php" method="post" enctype="multipart/form-data">
            Nome:<br>
            <input type="text" name="nome" required><br>

            E-mail:<br>
            <input type="email" name="email" required><br>

            Senha:<br>
            <input type="password" name="senha" required><br>

            Foto de Perfil:<br>
            <input type="file" name="foto" accept="image/*" required><br><br>

            <input type="submit" value="Registar">
        </form>
        <br>
        <a href="index.php">Voltar</a>

    </div>
</body>

</html>