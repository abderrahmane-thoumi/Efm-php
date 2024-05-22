<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentifier</title>
</head>
<body>
    <header>
        <h1>Authentification</h1>
    </header>
    <form action="verifAuth.php" method="POST">
        <label for="login">Login</label><br>
        <input type="text" name="login" id="login"><br>
        <label for="password">Mot de Passe</label><br>
        <input type="password" name="password" id="password"><br>
        <input type="submit" value="S'authentifier">
    </form>
    <p style='color:red;'>
        <?= isset($_SESSION['error']) ? $_SESSION['error'] : '' ?>
        <?php unset($_SESSION['error']); ?>
    </p>
</body>
</html>