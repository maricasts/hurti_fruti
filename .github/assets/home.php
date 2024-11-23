<?php
// Iniciar a sessão
session_start();

// Verificar se o usuário está logado (se a sessão 'email' existe)
if (!isset($_SESSION['email'])) {
    // Se o usuário não estiver logado, redirecionar para a página de login
    header("Location: login.php");
    exit();  // Certifique-se de que o script pare de ser executado após o redirecionamento
}

// Se o usuário estiver logado, recuperar o email
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
 <head>
  <meta charset="UTF-8"/>
  <meta content="width=device-width, initial-scale=1.0"/>
  <title>
   Hurti Fruti - Frutas para Provar
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #fbdada;
    }
    .fruit-card {
      width: 250px;
      padding: 20px;
      margin: 10px;
      text-align: center;
      background-color: #fff;
      border-radius: 15px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      cursor: pointer;
      transition: background-color 0.3s;
    }
    .fruit-card:hover {
      background-color: #ffedeb;
    }
    .menu-list {
      background-color: #fff;
      padding: 15px;
      margin-top: 10px;
      border-radius: 15px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      position: fixed;
      top: 0;
      left: -300px;
      height: 100%;
      width: 300px;
      transition: left 0.3s;
      z-index: 1000;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .menu-list.open {
      left: 0;
    }
    .menu-toggle {
      position: fixed;
      top: 20px;
      left: 20px;
      background-color: #ff3d3d;
      color: #fff;
      padding: 10px;
      border-radius: 50%;
      cursor: pointer;
      z-index: 1001;
    }
    .carousel {
      display: flex;
      overflow-x: auto;
      scroll-snap-type: x mandatory;
    }
    .carousel::-webkit-scrollbar {
      display: none;
    }
    .carousel-item {
      scroll-snap-align: start;
      flex: none;
    }
  </style>
 </head>
 <h1>Bem-vindo, <?php echo htmlspecialchars($email); ?>!</h1>
 <body class="flex flex-col items-center">
  <!-- Header -->
  <header class="bg-pink-500 text-white w-full p-4">
  </header>
  <!-- Menu Toggle Button -->
  <div class="menu-toggle" onclick="toggleMenu()">
   <i class="fas fa-bars">
   </i>
  </div>
  <!-- Menu de frutas escolhidas -->
  <div class="menu-list" id="menu-list">
   <div>
   </div>
   <div>
    <h3 class="text-xl font-bold mb-4">
     Frutas que você quer provar:
    </h3>
    <ul class="mt-4" id="menu">
     <!-- As frutas escolhidas irão aparecer aqui -->
    </ul>
   </div>
  </div>
  <!-- Main Content -->
  <main class="flex flex-col items-center p-6 md:p-12 w-full">
   <h2 class="text-3xl font-bold mb-6">
    Escolha as frutas que você quer provar!
   </h2>
   <div class="carousel">
    <!-- Frutas -->
    <div class="fruit-card carousel-item" onclick="addToMenu('Maçã')">
     <img alt="Maçã" class="mb-2" src="https://via.placeholder.com/150?text=Maçã"/>
     <p>
      Maçã
     </p>
    </div>
    <div class="fruit-card carousel-item" onclick="addToMenu('Banana')">
     <img alt="Banana" class="mb-2" src="https://via.placeholder.com/150?text=Banana"/>
     <p>
      Banana
     </p>
    </div>
    <div class="fruit-card carousel-item" onclick="addToMenu('Laranja')">
     <img alt="Laranja" class="mb-2" src="https://via.placeholder.com/150?text=Laranja"/>
     <p>
      Laranja
     </p>
    </div>
    <div class="fruit-card carousel-item" onclick="addToMenu('Uva')">
     <img alt="Uva" class="mb-2" src="https://via.placeholder.com/150?text=Uva"/>
     <p>
      Uva
     </p>
    </div>
    <div class="fruit-card carousel-item" onclick="addToMenu('Morango')">
     <img alt="Morango" class="mb-2" src="https://via.placeholder.com/150?text=Morango"/>
     <p>
      Morango
     </p>
    </div>
    <div class="fruit-card carousel-item" onclick="addToMenu('Abacaxi')">
     <img alt="Abacaxi" class="mb-2" src="https://via.placeholder.com/150?text=Abacaxi"/>
     <p>
      Abacaxi
     </p>
    </div>
    <div class="fruit-card carousel-item" onclick="addToMenu('Melancia')">
     <img alt="Melancia" class="mb-2" src="https://via.placeholder.com/150?text=Melancia"/>
     <p>
      Melancia
     </p>
    </div>
    <div class="fruit-card carousel-item" onclick="addToMenu('Manga')">
     <img alt="Manga" class="mb-2" src="https://via.placeholder.com/150?text=Manga"/>
     <p>
      Manga
     </p>
    </div>
   </div>
  </main>
  <script>
    // Função para adicionar frutas ao menu
    function addToMenu(fruit) {
      const menu = document.getElementById('menu');
      
      // Verificar se a fruta já foi adicionada
      if (!Array.from(menu.children).some(item => item.textContent === fruit)) {
        const li = document.createElement('li');
        li.textContent = fruit;
        li.classList.add('mb-2', 'text-lg');
        menu.appendChild(li);
      } else {
        alert("Você já escolheu essa fruta!");
      }
    }

    // Função para alternar o menu
    function toggleMenu() {
      const menuList = document.getElementById('menu-list');
      menuList.classList.toggle('open');
    }
  </script>
 </body>
</html>