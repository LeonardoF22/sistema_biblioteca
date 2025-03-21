<?php
require 'conexao.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Recebendo o numero de serie do formulario e verificando se ele ja esta cadastrado no banco
  $numero = $_POST['numero'];
  $cadastrado = $conn -> query("SELECT * FROM tb_livros WHERE Numero = $numero") -> fetch_assoc();
  if($cadastrado != null) {
    echo "<script>alert('Livro já cadastrado!');</script>";
  } else {
    // Recebendo os outros dados do formulario
    $titulo = $_POST['titulo'];
    $ano = $_POST['ano'];
    $autor = $_POST['autor'];
    $categoria = $_POST['categoria'];
    $qtde_exemplares = $_POST['exemplares'];
    // Enviando para o banco
    $stmt = $conn->prepare("INSERT INTO tb_livros (Numero, Titulo, Ano_publicacao, Autor, Categoria, qtde_exemplares) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $numero, $titulo, $ano, $autor, $categoria, $qtde_exemplares);
    $stmt->execute();
    header('Location: cadastro_livros.php');
    exit;
  }
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
        <h2 class="display-5 mb-4">BIBLIOTECA | Cadastro de Livros</h2>
        <form id="form1" name="form1" method="POST" action="#">
          <fieldset>
            <legend>Dados do livro</legend>
            <!-- inicío da primeira linha -->
            <div class="form-row">
              <div class="form-group col-2">                    
                  <label for="numero">Número de série:</label>
                  <input type="number" class="form-control" id="numero" name="numero" placeholder="0000" required>
              </div>
              <div class="form-group col-6">                    
                <label for="titulo">Título:</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" required>
              </div>
              <div class="form-group col-4">                    
                <label for="ano">Ano de Publicação:</label>
                <input type="number" class="form-control" id="ano" name="ano" required>
              </div>                  
            </div>
            <!-- fim da primeira linha -->

            <!-- inicío da segunda linha -->
            <div class="form-row">
              <div class="form-group col-5">                    
                  <label for="autor">Autor:</label>
                  <input type="text" class="form-control" id="autor" name="autor" placeholder="Autor" required>
              </div>
              <div class="form-group col-5">                    
                <label for="categoria">Categoria:</label>
                <input type="text" class="form-control" id="categoria" name="categoria" placeholder="Categoria" required>
              </div> 
              <div class="form-group col-2">
                <label for="exemplares">Qtde Exemplares:</label>
                <input type="number" class="form-control" name="exemplares" id="exemplares" required>
              </div>               
            </div>
          <!-- fim da segunda linha --> 
          </fieldset>

          <div class="form-row">              
              <div class="form-group col-6 ">                    
                <a href="index.html" class="">Voltar para menu</a> 
              </div>  
              <div class="form-group col-6">                    
                <button type="submit" class="btn btn-primary btn-lg">Cadastrar Livro</button> 
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