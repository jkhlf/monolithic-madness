<?php
require_once '../config/config.php';
if (isLoggedIn()) {
    redirect('/dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Login</title>
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/style.css">
</head>
<body>
    <div class="container">
        <div class="form-box" id="login-form">
            <h2>Login</h2>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>
            <form action="login.php" method="POST">
                <div class="input-group">
                    <input type="text" name="username" placeholder="Usuário" required>
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Senha" required>
                </div>
                <button type="submit" name="login">Entrar</button>
            </form>
            <p>Não tem uma conta? <a href="#" onclick="toggleForms()">Registre-se</a></p>
        </div>

        <div class="form-box" id="register-form" style="display: none;">
            <h2>Registro</h2>
            <form action="register.php" method="POST">
                <div class="input-group">
                    <input type="text" name="username" placeholder="Usuário" required>
                </div>
                <div class="input-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Senha" required>
                </div>
                <button type="submit" name="register">Registrar</button>
            </form>
            <p>Já tem uma conta? <a href="#" onclick="toggleForms()">Login</a></p>
        </div>
    </div>
    <script src="<?= ASSETS_URL ?>/js/script.js"></script>
</body>
</html>