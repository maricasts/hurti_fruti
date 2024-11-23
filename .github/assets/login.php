<html lang="pt-br">
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
    <label for="email" class="custom-cursor-default-hover">
     E-mail:
    </label>
    <input id="email" name="email" required="" type="email"/>
    <label for="password" class="custom-cursor-default-hover">
     Senha:
    </label>
    <input id="password" name="password" required="" type="password"/>
    <button type="submit">
     Entrar
    </button>
   </form>
  </div>
 </body>
</html>