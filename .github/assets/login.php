<?php
// Iniciar a sessão
session_start();

// Exibir erros para depuração (remova ou comente em produção)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir a conexão com o banco de dados
include('conexao.php'); // Ajuste o caminho conforme necessário

// Inicializar a variável de erro
$erro = '';

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter os dados do formulário
    $email = trim($_POST['email']);
    $senha = trim($_POST['password']);

    // Validar se os campos não estão vazios
    if (empty($email) || empty($senha)) {
        $erro = 'Por favor, preencha todos os campos.';
    } else {
        // Consultar o banco de dados para verificar o usuário
        $stmt = $conn->prepare("SELECT * FROM usuario WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        // Verificar se o usuário existe
        if ($resultado->num_rows > 0) {
            // Obter os dados do usuário
            $usuario = $resultado->fetch_assoc();

            // Verificar se a senha fornecida é correta
            if (password_verify($senha, $usuario['senha'])) {
                // Login bem-sucedido
                $_SESSION['email'] = $email; // Armazenar o email na sessão
                header('Location: home.php'); // Redirecionar para a página inicial
                exit();
            } else {
                $erro = 'Senha incorreta.';
            }
        } else {
            $erro = 'Usuário não encontrado.';
        }
    }

    // Fechar a conexão
    $stmt->close();
    $conn->close();
}?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-form">
        <h2>Login</h2>

        <?php
        // Exibir mensagem de erro caso haja
        if (!empty($erro)) {
            echo "<p class='error'>$erro</p>";
        }
        ?>

        <form action="login.php" method="POST">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
