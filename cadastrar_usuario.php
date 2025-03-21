<?php
require 'conexao.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Recebendo o RA do formulario e verificando se ele ja esta cadastrado no banco
  $ra = $_POST['ra'];
  $cadastrado = $conn -> query("SELECT * FROM tb_usuarios WHERE Ra = $ra") -> fetch_assoc();
  if($cadastrado != null) {
    echo "<script>alert('Usuário já cadastrado!');</script>"; 
  } else { 
    // Recebendo os outros dados do formulario
    $nome = $_POST['nome'];
    $data_ingresso = $_POST['ingresso'];
    $curso = $_POST['curso'];
    $telefone = $_POST['telefone'];
    // Enviando para o banco
    $stmt = $conn->prepare("INSERT INTO tb_usuarios (Ra, Nome, Data_ingresso, curso, Telefone) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $ra, $nome, $data_ingresso, $curso, $telefone);
    $stmt->execute();
    echo "<script>alert('Usuário cadastrado com sucesso!');</script>";  
  }
  header('Location: cadastrar_usuario.php');
  exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="estilo.css">
    <title></title>
  </head>
  <body class="bg-dark">
    <div class="container">
      <h1></h1>

      <!-- MENU PRINCIPAL PARA NAVEGAÇÃO -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarTogglerDemo02">
          <ul class="navbar-nav mx-auto mt-5 mb-2">
              <li class="nav-item active">
                <a class="nav-link mx-5 font-menu" href="index.html">Home</a>
              </li>
              <li class="nav-item mx-5 dropdown">
                <a class="nav-link dropdown-toggle font-menu" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Cadastros
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="cadastrar_usuario.php">Usuários</a>
                  <a class="dropdown-item" href="cadastro_livros.php">Livros</a>
                </div>
              </li> 
              <li class="nav-item">
                <a class="nav-link mx-5 font-menu" href="emprestimo.php">Empréstimo</a>
              </li>
          </ul>
        </div>
      </nav>
      <!-- FIM MENU -->

      <main class="bg-light p-5">
        <h2 class="display-5 mb-4">BIBLIOTECA | Cadastro de Usuários</h2>
        <form id="form1" name="form1" method="POST" action="cadastrar_usuario.php">
          <fieldset>
            <legend>Dados pessoais</legend>
            <!-- inicío da primeira linha -->
            <div class="form-row">
              <div class="form-group col-2">                    
                  <label for="ra">RA:</label>
                  <input type="text" class="form-control" id="ra" name="ra" value=""  placeholder="0000" required>
              </div>
              <div class="form-group col-6">                    
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome completo">
              </div>
              <div class="form-group col-4">                    
                <label for="ingresso">Data Ingresso:</label>
                <input type="date" class="form-control" id="ingresso" name="ingresso">
              </div>                  
            </div>
            <!-- fim da primeira linha -->

            <!-- inicío da segunda linha -->
            <div class="form-row">
              <div class="form-group col-6">                    
                  <label for="curso">Curso:</label>
                  <input type="text" class="form-control" id="curso" name="curso" placeholder="Curso" required>
              </div>
              <div class="form-group col-6">                    
                <label for="telefone">Telefone:</label>
                <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone">
              </div>                
            </div>
          <!-- fim da segunda linha --> 
          </fieldset>

          <div class="form-row">              
              <div class="form-group col-6 ">                    
                <a href="index.html" class="">Voltar para menu</a> 
              </div>  
              <div class="form-group col-6">                    
                <button type="submit" class="btn btn-primary btn-lg">Cadastrar Usuário</button> 
              </div>               
          </div>      
        </form>  
      </main>

    </div>

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>