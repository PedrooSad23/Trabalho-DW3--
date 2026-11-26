<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Adicionado o link para o CSS externo -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <form action="verificar_login.php" method="post">
            E-mail: <br>
            <input type="text" name="email" placeholder="lindo@email.com"> <br>
            Senha: <br>
            <input type="password" name="senha"> <br>

            <input type="submit" value="Logar">
        </form>

        <a href="cadastro.php">Não tenho cadastro.</a>
    </div>
</body>
</html>