<?php
        //1. Conectar no BD (IP, usuario, senha, nome do banco)
        require_once("verificaAutenticacao.php");
        require_once("conexao.php");
        if (isset($_POST['salvar'])) {

            //2. Receber os dados para inserir no BD
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $telefone = $_POST['telefone'];
            $endereco = $_POST['endereco'];
            $cidade = $_POST['cidade'];
            $uf = $_POST['uf'];
            $sexo = $_POST['sexo'];
            $dataNascimento = $_POST['dataNascimento'];
            $cpf = $_POST['cpf'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            //3. Preparar a SQL
        $sql = "update cliente set nome = '$nome', telefone = '$telefone', endereco = '$endereco', cidade = '$cidade', UF = '$uf', sexo = '$sexo', dataNascimento = '$dataNascimento', CPF = '$cpf', email = '$email', senha = '$senha' where id = $id";

            //4. Executar a SQL
            mysqli_query($conexao, $sql);

            //5. Mostrar mensagem ao usuário
            $mensagem = "Alterado com sucesso";
        }
            //Busca o usuário selecionado pelo usuarioListar.php
            $sql = "select * from cliente where id = " . $_GET['id'];
            $resultado = mysqli_query($conexao, $sql);
            $linha = mysqli_fetch_array($resultado);
        ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Editar Cliente</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <script src="https://kit.fontawesome.com/0215a38eba.js" crossorigin="anonymous"></script>
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

    <?php require_once("sidebarAdmin.php"); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

    <?php require_once("topbarAdmin.php"); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="container">
        <h1 class="mb-4"><i class="fa-solid fa-calendar-days"></i> Editar Cliente</h1>
        <form method="post">
        <input type="hidden" name="id" value="<?= $linha['id']?>">
            <div class="mb-1">
                <label for="formGroupExampleInput" class="form-label">Nome</label>
                <input name="nome" type="text" class="form-control" value="<?=$linha['nome'] ?>"><br>
            </div>
            <div class="mb-1">
                <label for="formGroupExampleInput" class="form-label">Telefone</label>
                <input name="telefone" type="text" class="form-control" value="<?=$linha['telefone'] ?>"><br>
            </div>
            <div class="mb-1">
                <label for="formGroupExampleInput" class="form-label">Endereço</label>
                <input name="endereco" type="text" class="form-control" value="<?=$linha['endereco'] ?>"><br>
            </div>
            <div class="mb-1">
                <label for="formGroupExampleInput" class="form-label">Cidade</label>
                <input name="cidade" type="text" class="form-control" value="<?=$linha['cidade'] ?>"><br>
            </div>
            <div class="mb-1">
                <label for="formGroupExampleInput" class="form-label">UF</label>
                <input name="uf" type="text" class="form-control" value="<?=$linha['UF'] ?>"><br>
            </div>
            <div class="mb-1">
                <label for="formGroupExampleInput" class="form-label">Sexo</label>
                <input name="sexo" type="text" class="form-control" value="<?=$linha['sexo'] ?>"><br>
            </div>
            <div class="mb-1">
                <label for="formGroupExampleInput" class="form-label">Data de Nascimento</label>
                <input name="dataNascimento" type="date" class="form-control" value="<?=$linha['dataNascimento'] ?>"><br>
            </div>
            <div class="mb-1">
                <label for="formGroupExampleInput" class="form-label">CPF</label>
                <input name="cpf" type="text" class="form-control" value="<?=$linha['CPF'] ?>"><br>
            </div>
            <div class="mb-1">
                <label for="formGroupExampleInput" class="form-label">Email</label>
                <input name="email" type="email" class="form-control" value="<?=$linha['email'] ?>"><br>
            </div>
            <div class="mb-1">
                <label for="formGroupExampleInput" class="form-label">Senha</label>
                <input name="senha" type="password" class="form-control" value="<?=$linha['senha'] ?>"><br>
                <button name="salvar" type="submit" class="btn btn-primary"><i class="fa-solid fa-check"></i> Salvar</button>
            <a href="listagemCliente.php" class="btn btn-warning"><i class="fa-solid fa-rotate-left"></i> Voltar</a>
            </div>
            </div>


        </form><br>
        <?php if (isset($mensagem)) { ?>
            <div class="alert alert-success mb-2" role="alert">
                <i class="fa-solid fa-check" style="color: #12972c;"></i>
                <?= $mensagem ?>
            </div>
        <?php } 
        require_once("footer.php");
        ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>