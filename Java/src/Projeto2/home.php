<?php
session_start();

// Proteção da página: se não houver sessão de usuário, redireciona para o login
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit;
}

// Obtém o nome do usuário logado (o e-mail neste caso)
$usuario = htmlspecialchars($_SESSION['usuario']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Restrita - P2 DSI</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #e9ecef; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; text-align: center;}
        .container { background-color: #ffffff; padding: 40px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); max-width: 600px; }
        h1 { color: #28a745; margin-bottom: 20px; }
        p { color: #495057; font-size: 18px; line-height: 1.6; }
        .logout-btn { display: inline-block; margin-top: 30px; padding: 10px 20px; background-color: #dc3545; color: white; text-decoration: none; border-radius: 4px; transition: background-color 0.3s ease; }
        .logout-btn:hover { background-color: #c82333; }
        .info { color: #007bff; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h1>&#9989; Acesso Bem-Sucedido!</h1>
        <p>Bem-vindo(a), <span class="info"><?= $usuario ?></span>!</p>
        <p>Esta é a sua área restrita no sistema. Aqui o conteúdo exclusivo seria exibido após a autenticação.</p>
        <a href="logout.php" class="logout-btn">Sair (Logout)</a>
    </div>
</body>
</html>