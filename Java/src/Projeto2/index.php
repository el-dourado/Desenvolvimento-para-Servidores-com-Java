<?php
session_start();
// Se o usuário já estiver logado, redireciona para a página restrita
if (isset($_SESSION['usuario'])) {
    header('Location: home.php');
    exit;
}

$erro = $_SESSION['erro_login'] ?? '';
unset($_SESSION['erro_login']); // Limpa a mensagem após exibir
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - P2 DSI</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .container { background-color: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); width: 300px; }
        h2 { text-align: center; color: #333; margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; color: #555; font-weight: bold; }
        input[type="text"], input[type="password"] { width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; transition: background-color 0.3s ease; }
        button:hover { background-color: #0056b3; }
        .links { text-align: center; margin-top: 15px; }
        .links a { color: #007bff; text-decoration: none; font-size: 14px; }
        .links a:hover { text-decoration: underline; }
        .erro { color: red; text-align: center; margin-bottom: 15px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Acesso ao Sistema</h2>

        <?php if ($erro): ?>
            <p class="erro"><?= htmlspecialchars($erro) ?></p>
        <?php endif; ?>

        <!-- Formulário de Login -->
        <form method="post" action="funcoes.php?acao=login">
            <label for="usuario">Usuário (E-mail):</label>
            <input type="text" id="usuario" name="usuario" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <button type="submit">Entrar</button>
        </form>

        <div class="links">
            <!-- Link "Esqueci a Senha" -->
            <a href="recuperar_senha.php">Esqueci a Senha</a>
        </div>
    </div>
</body>
</html>