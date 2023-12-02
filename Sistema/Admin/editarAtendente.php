<?php
//1. Conectar no BD (IP, usuario, senha, nome do banco)
require_once("verificaAutenticacao.php");
require_once("conexao.php");

//Busca o usuário selecionado pelo usuarioListar.php
$sql = "select * from atendente where id = " . $_GET['id'];
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

    <title>Editar Veterinário</title>

    <!-- Custom fonts for this template-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="js/javascript.js"></script>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
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
                    <!-- Editar Médico Veterinário -->
                    <div class="container">
                        <h1 class="mb-4"><i class="fa-solid fa-calendar-days"></i> Editar Veterinário</h1>
                        <form method="post">
                            <input type="hidden" name="id" value="<?= $linha['id'] ?>">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-1">
                                        <label for="formGroupExampleInput" class="form-label">Nome</label>
                                        <input name="nome" type="text" class="form-control" value="<?= $linha['nome'] ?>"><br>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-1">
                                        <label for="formGroupExampleInput" class="form-label">Email</label>
                                        <input name="email" type="email" class="form-control" value="<?= $linha['email'] ?>"><br>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="mb-1">
                                        <label for="formGroupExampleInput" class="form-label">Telefone</label>
                                        <input name="telefone" type="text" maxlength="15" class="form-control" onkeyup="handlePhone(event)" value=" <?= $linha['telefone'] ?>"><br>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-1">
                                        <label for="formGroupExampleInput" class="form-label">Data de Nascimento</label>
                                        <input name="dataNascimento" type="date" class="form-control" value="<?= $linha['dataNascimento'] ?>"><br>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-1">
                                        <label for="formGroupExampleInput" class="form-label">CPF</label>
                                        <input name="cpf" type="text" class="form-control" maxlength="15" value="<?= $linha['cpf'] ?>" oninput="applyCpfMask(this)"><br>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <label for="sexo" class="form-label">Sexo</label>
                                    <select id="sexo" name="sexo" class="form-control">
                                        <option value="M" <?php echo ($linha['sexo'] == 'M') ? 'selected' : ''; ?>>Masculino</option>
                                        <option value="F" <?php echo ($linha['sexo'] == 'F') ? 'selected' : ''; ?>>Feminino</option>
                                        <option value="O" <?php echo ($linha['sexo'] == 'O') ? 'selected' : ''; ?>>Outro</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <div class="mb-1">
                                        <label for="formGroupExampleInput" class="form-label">Senha</label>
                                        <input name="senha" id="senha" type="password" class="form-control" value="<?= $linha['senha'] ?>">
                                        <button type="button" id="togglePass" class="botao btn btn-link">Mostrar Senha</button>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-1">
                                        <div class="mb-1">
                                            <label for="formGroupExampleInput" class="form-label">Data de Demissão</label>
                                            <input name="dataDemissao" id="dataDemissao" type="date" class="form-control" value="<?= $linha['dataDemissao'] ?>">
                                            <button type="button" class="btn" onclick="limpar()">Limpar</button>
                                            <!-- Adicione um campo oculto para enviar um valor especial quando o botão "Limpar" for clicado -->
                                            <input type="hidden" name="limparDataDemissao" id="limparDataDemissao" value="0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button name="salvar" type="submit" class="btn btn-primary"><i class="fa-solid fa-check"></i>
                                Salvar</button>
                            <a href="listagemAtendente.php" class="btn btn-warning"><i class="fa-solid fa-rotate-left"></i>
                                Voltar</a>
                    </div>
                </div>
                </form><br>
            </div>

            <script>
                function limpar() {
                    document.getElementById("dataDemissao").value = null;
                    // Defina o valor do campo oculto como 1 quando o botão "Limpar" for clicado
                    document.getElementById("limparDataDemissao").value = 1;
                }

                const senhaInput = document.querySelector("#senha");
                const togglePassButton = document.querySelector("#togglePass");
                togglePassButton.addEventListener('click', togglePass);

                function togglePass() {
                    if (senhaInput.type == "password") {
                        senhaInput.type = "text";
                        togglePassButton.textContent = "Esconder Senha";
                    } else {
                        senhaInput.type = "password";
                        togglePassButton.textContent = "Mostrar Senha";
                    }
                }
            </script>

            <?php
            if (isset($_POST['salvar'])) {

                //2. Receber os dados para inserir no BD
                $id = $_POST['id'];
                $nome = $_POST['nome'];
                $telefone = $_POST['telefone'];
                $dataNascimento = $_POST['dataNascimento'];
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                $cpf = $_POST['cpf'];
                $sexo = $_POST['sexo'];
                $dataDemissao = isset($_POST['limparDataDemissao']) && $_POST['limparDataDemissao'] == 1 ? null : $_POST['dataDemissao'];

                // Certifique-se de que o valor é realmente nulo
                if ($dataDemissao === null) {
                    // Converta explicitamente para NULL
                    $dataDemissao = "NULL";
                }

                // Verificar se a data de demissão foi fornecida
                if (!empty($dataDemissao) || $dataDemissao == "0000-00-00") {

                    // Atualizar o registro do veterinário no banco de dados
                    $sql = "UPDATE atendente SET nome = '$nome', telefone = '$telefone', sexo = '$sexo', dataNascimento = '$dataNascimento', email = '$email', senha = '$senha' , statusAt = 'Inativo', cpf = '$cpf', dataDemissao = '$dataDemissao' WHERE id = $id";
                } else {
                    //3. Preparar a SQL
                    $sql = "UPDATE atendente SET nome = '$nome', telefone = '$telefone', sexo = '$sexo', dataNascimento = '$dataNascimento', email = '$email', senha = '$senha' , statusAt = 'Ativo', cpf = '$cpf', dataDemissao = '$dataDemissao' WHERE id = $id";
                }
                //4. Executar a SQL
                mysqli_query($conexao, $sql);

                //5. Mostrar mensagem ao usuário
                $mensagem = "Alterado com sucesso";
            }
            ?>

            <!-- Mostrar mensagem ao usuário -->
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