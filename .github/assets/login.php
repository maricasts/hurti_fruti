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
<head>
  <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
     Login
    </title>
    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet"/>
    <style>
     body {
            font-family: 'Roboto', sans-serif;
            background-color: #fbdada;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-form {
            width: 90%;
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .login-form h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #ff3d3d;
            font-weight: bold;
            font-size: 24px;
        }
        .login-form label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        .login-form input[type="email"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .login-form button {
            width: 100%;
            padding: 10px;
            background-color: #ff3d3d;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .login-form button:hover {
            background-color: #e63636;
        }
        .error {
            color: #ff3d3d;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
   </meta>
  </meta>
 </head>
 <body>
  <div class="login-form">
   <h1>
    Login
   </h1>
   <?php
        // Exibir mensagem de erro caso haja
        if (!empty($erro)) {
            echo "<p class='error'>$erro</p>";
        }
        ?>
   <form action="login.php" method="POST">
    <label for="email" class="custom-cursor-default-hover" required>
     E-mail:
    </label>
    <input id="email" name="email" type="email" required/>
    <label for="password" class="custom-cursor-default-hover" required>
     Senha:
    </label>
    <input id="password" name="password" type="password" required/>
    <button type="submit">
     Entrar
    </button>
   </form>
  </div>
 </body>
</html>