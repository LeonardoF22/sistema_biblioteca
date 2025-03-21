<?php
require 'conexao.php';
date_default_timezone_set('America/Sao_Paulo');
$alunos = $conn -> query("SELECT Id_usuario, Nome FROM tb_usuarios") -> fetch_all(MYSQLI_ASSOC);
$livros = $conn -> query("SELECT Id_livro, Titulo FROM tb_livros WHERE qtde_exemplares > 0") -> fetch_all(MYSQLI_ASSOC);

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebendo os dados do formulario
    $id_aluno = $_POST['aluno'];
    $id_livro = $_POST['livro'];
    $data_emprestimo = $_POST['data_emprestimo'];
    $data_devolucao = $_POST['data_devolucao'];
    // Enviando os dados para o banco
    $stmt = $conn->prepare("INSERT INTO tb_emprestimos(Data_emprestimo, Data_devolucao, Id_usuario, Id_livro) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $data_emprestimo, $data_devolucao, $id_aluno, $id_livro);
    $stmt->execute();
    $stmt->close();

    // Alterando a quantidade de exemplares
    $consulta = $conn->query("SELECT qtde_exemplares FROM tb_livros WHERE Id_livro = $id_livro")->fetch_assoc();
    $qtde_exemplares = $consulta["qtde_exemplares"] - 1;
    $stmt = $conn->prepare("UPDATE tb_livros SET qtde_exemplares = ? WHERE Id_livro = ?");
    $stmt->bind_param("ii", $qtde_exemplares, $id_livro);
    $stmt->execute();
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
        <h2 class="display-5 mb-4">BIBLIOTECA | Emprestimo de livros</h2>
        <form id="form1" name="form1" method="POST" action="emprestimo.php">
          <fieldset>
            <legend>Dados</legend>
            <!-- inicío da primeira linha -->
            <div class="form-row">
              <div class="form-group col-6">                    
                  <label for="aluno">Nome do aluno:</label>
                  <select name="aluno" id="aluno" class="form-control" required>
                    <option disabled selected>Selecione...</option>
                    <?php foreach($alunos as $aluno): ?>
                      <option value="<?= $aluno['Id_usuario'] ?>"><?= $aluno['Nome'] ?></option>
                    <?php endforeach ?>
                  </select>
              </div>
              <div class="form-group col-6">                    
                <label for="livro">Título do livro:</label>
                <select name="livro" id="livro" class="form-control" required>
                  <option disabled selected>Selecione...</option>
                  <?php foreach($livros as $livro): ?>
                    <option value="<?= $livro['Id_livro'] ?>"><?= $livro['Titulo'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>                 
            </div>
            <!-- fim da primeira linha -->

            <!-- inicío da segunda linha -->
            <div class="form-row">
              <div class="form-group col-6">                    
                  <label for="data_emprestimo">Data de empréstimo:</label>
                  <input type="date" class="form-control" id="data_emprestimo" name="data_emprestimo" value="<?= date("Y-m-d") ?>" readonly>
              </div>
              <div class="form-group col-6">                    
                <label for="telefone">Data de devolução:</label>
                <input type="date" class="form-control" id="data_devolucao" name="data_devolucao" min="<?= date("Y-m-d") ?>" required>
              </div>                
            </div>
          <!-- fim da segunda linha --> 
          </fieldset>

          <div class="form-row">              
              <div class="form-group col-6 ">                    
                <a href="index.html" class="">Voltar para menu</a> 
              </div>  
              <div class="form-group col-6">                    
                <button type="submit" class="btn btn-primary btn-lg">Cadastrar Emprestimo</button> 
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