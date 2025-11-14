<?php
session_start();
$mensagem = $_SESSION['mensagem_recuperacao'] ?? '';
unset($_SESSION['mensagem_recuperacao']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha - P2 DSI</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .container { background-color: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); width: 300px; }
        h2 { text-align: center; color: #333; margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; color: #555; font-weight: bold; }
        input[type="email"] { width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background-color: #ffc107; color: #333; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; transition: background-color 0.3s ease; }
        button:hover { background-color: #e0a800; }
        .links { text-align: center; margin-top: 15px; }
        .links a { color: #007bff; text-decoration: none; font-size: 14px; }
        .links a:hover { text-decoration: underline; }
        .info { color: green; text-align: center; margin-bottom: 15px; font-weight: bold; }
        .alerta { color: #dc3545; text-align: center; margin-bottom: 15px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Esqueci a Senha</h2>

        <?php if ($mensagem): ?>
            <p class="info"><?= htmlspecialchars($mensagem) ?></p>
        <?php endif; ?>
        
        <!-- Formulário de Recuperação de Senha -->
        <form method="post" action="funcoes.php?acao=recuperar">
            <label for="email_recuperacao">E-mail de Cadastro:</label>
            <input type="email" id="email_recuperacao" name="email_recuperacao" required>

            <button type="submit">Recuperar Senha</button>
        </form>

        <div class="links">
            <a href="index.php">Voltar para o Login</a>
        </div>
        <p class="alerta" style="margin-top: 20px;">*A nova senha temporária será **Fatec2025SI**.</p>
    </div>
</body>
</html>