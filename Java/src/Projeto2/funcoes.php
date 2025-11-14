<?php
session_start();

// --- CONFIGURAÇÃO ---
// E-mail de destino para NOTIFICAÇÃO DE ACESSO BEM-SUCEDIDO
const EMAIL_NOTIFICACAO_ACESSO = 'marcos.sousa12@fatec.sp.gov.br';
// Nova senha temporária
const SENHA_TEMPORARIA = 'Fatec2025SI';
// Simulação de base de dados (Usuário => Hash da senha)
// Senha para 'admin@fatec.sp.gov.br' é 'Fatec123' (Hash gerado)
// Senha para 'teste@fatec.sp.gov.br' é 'senha123' (Hash gerado)
$usuarios_mock = [
    'admin@fatec.sp.gov.br' => '$2y$10$tREBn3TBeVN2gjjTzGQqB3OYDSZDWBMH4f7JGdNoAVVLeztijk', // Hash para Fatec123
    'teste@fatec.sp.gov.br' => '$2y$10$3p68x79PNO/x7whLFODru3nygIG5QZBM56cNQoKTZGyfAoT/302',  // Hash para senha123
];

// --- PHPMailer Config (AJUSTE AQUI) ---
// Use o Composer para instalar: composer require phpmailer/phpmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Configurações SMTP (Use sua senha de App do Gmail ou outro serviço)
const SMTP_HOST = 'smtp.gmail.com';
const SMTP_USERNAME = 'seu_email_para_envio@gmail.com'; // **MUDAR** - Seu e-mail de envio
const SMTP_PASSWORD = 'sua_senha_de_app_aqui'; // **MUDAR** - Sua Senha de App/Token
const SMTP_PORT = 465;

// --- FUNÇÕES DE E-MAIL ---

/**
 * Envia e-mail usando PHPMailer.
 * @param string $destinatario E-mail para onde a mensagem será enviada.
 * @param string $assunto Assunto do e-mail.
 * @param string $corpo Conteúdo HTML do e-mail.
 * @return bool True em caso de sucesso, False caso contrário.
 */
function enviarEmail($destinatario, $assunto, $corpo) {
    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor
        $mail->isSMTP();
        $mail->Host       = SMTP_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = 'gabrielmartinsdourado71@gmail.com';
        $mail->Password   = 'ptqgxrtawexydozs';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = SMTP_PORT;
        $mail->CharSet    = 'UTF-8';

        // Remetente e Destinatário
        $mail->setFrom(SMTP_USERNAME, 'Sistema P2 DSI');
        $mail->addAddress($destinatario);

        // Conteúdo
        $mail->isHTML(true);
        $mail->Subject = $assunto;
        $mail->Body    = $corpo;
        $mail->AltBody = strip_tags($corpo); // Versão texto simples

        $mail->send();
        return true;
    } catch (Exception $e) {
        // Loga o erro, mas não exibe para o usuário
        error_log("Erro ao enviar e-mail para $destinatario: {$mail->ErrorInfo}");
        return false;
    }
}

/**
 * Envia notificação para o e-mail central após login bem-sucedido.
 * (Requisito Específico: marcos.sousa12@fatec.sp.gov.br)
 * @param string $usuario_email O e-mail do usuário que logou.
 */
function notificarAcessoBemSucedido($usuario_email) {
    $data_acesso = (new DateTime('now', new DateTimeZone('America/Sao_Paulo')))->format('d/m/Y H:i:s');
    $assunto = "Acesso bem-sucedido ao Sistema";
    $corpo = "
        <h2>Notificação de Acesso ao Sistema P2 DSI</h2>
        <p>O usuário **{$usuario_email}** realizou um login bem-sucedido no sistema.</p>
        <p><strong>Data e Hora do Acesso:</strong> {$data_acesso} (Horário de Brasília)</p>
        <p>Esta é uma notificação automática.</p>
    ";
    
    // O sistema deve tentar notificar o e-mail central
    enviarEmail(EMAIL_NOTIFICACAO_ACESSO, $assunto, $corpo);
}

/**
 * Envia e-mail de recuperação de senha.
 * @param string $destinatario E-mail do usuário para recuperar.
 */
function enviarRecuperacaoSenha($destinatario) {
    $assunto = "Recuperação de Senha - Sistema P2 DSI";
    $corpo = "
        <h2>Recuperação de Senha</h2>
        <p>Sua solicitação de recuperação de senha foi processada.</p>
        <p>Sua senha foi **resetada temporariamente**.</p>
        <p>A nova senha temporária é:</p>
        <p style='font-size: 1.2em; font-weight: bold; color: #dc3545;'><strong>" . SENHA_TEMPORARIA . "</strong></p>
        <p>Recomendamos que você realize o login e altere sua senha imediatamente.</p>
        <p>Atenciosamente,<br>Equipe de Suporte.</p>
    ";

    return enviarEmail($destinatario, $assunto, $corpo);
}

// --- CONTROLE DE AÇÕES ---

$acao = $_GET['acao'] ?? '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    if ($acao === 'login') {
        $usuario = trim($_POST['usuario'] ?? '');
        $senha = $_POST['senha'] ?? '';

        // 1. Verifica se o usuário existe (MOCADO)
        if (isset($usuarios_mock[$usuario])) {
            $hash_armazenado = $usuarios_mock[$usuario];

            // 2. Valida a senha usando hash
            if (password_verify($senha, $hash_armazenado)) {
                
                // --- LOGIN BEM-SUCEDIDO ---
                $_SESSION['usuario'] = $usuario;
                
                // 3. Requisito: Enviar notificação de acesso
                notificarAcessoBemSucedido($usuario);
                
                // 4. Redirecionar para a Página Restrita
                header('Location: home.php');
                exit;

            } else {
                // Senha inválida
                $_SESSION['erro_login'] = 'Usuário ou senha inválidos.';    
                header('Location: index.php');
                exit;
            }
        } else {
            // Usuário não encontrado
            $_SESSION['erro_login'] = 'Usuário ou senha inválidos.';
            header('Location: index.php');
            exit;
        }
    }
    
    if ($acao === 'recuperar') {
        $email_recuperacao = trim($_POST['email_recuperacao'] ?? '');

        // Simulação de validação da existência do e-mail (MOCADO)
        if (isset($usuarios_mock[$email_recuperacao])) {
            
            // Requisito: Enviar e-mail com a nova senha temporária
            if (enviarRecuperacaoSenha($email_recuperacao)) {
                $_SESSION['mensagem_recuperacao'] = "Nova senha temporária enviada para: " . htmlspecialchars($email_recuperacao) . ".";
            } else {
                $_SESSION['mensagem_recuperacao'] = "Erro ao enviar e-mail. Verifique as configurações SMTP.";
            }

        } else {
            // Se o e-mail não existe, damos uma mensagem genérica para não vazar informações
            $_SESSION['mensagem_recuperacao'] = "Se o e-mail estiver cadastrado, uma instrução foi enviada.";
        }
        
        header('Location: recuperar_senha.php');
        exit;
    }
}

// Se a requisição não for POST ou a ação for inválida, volta para o login
header('Location: index.php');
exit;