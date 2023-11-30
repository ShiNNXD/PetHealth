<!-- Requisita a verificação de autenticação -->
<?php require_once("verificaAutenticacao.php");
require_once("conexao.php"); ?>
<!DOCTYPE html>
<html lang="pt-br">


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cadastro de Veterinário</title>

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
    <style>
        .botao {
            height: 15px;
            width: 120px;
            font-size: 12px;
            padding-bottom: 20px;
        }
    </style>


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
                    <!-- Cadastrar Médico Veterinário -->
                    <div class="container">
                        <h1 class="mb-4"><i class="fa-solid fa-user-doctor"></i> Cadastro de Veterinário</h1>
                        <form method="post" onsubmit="return validarTelefone();">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-1">
                                        <label for="formGroupExampleInput" class="form-label">Nome</label>
                                        <input name="nomeVet" type="text" class="form-control" value="<?= isset($_POST['nomeVet']) ? htmlspecialchars($_POST['nomeVet']) : '' ?>" required><br>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="mb-1">
                                        <label for="formGroupExampleInput" class="form-label">Telefone</label>
                                        <input name="telefone" type="text" id="telefone" maxlength="15" class="form-control" value="<?= isset($_POST['telefone']) ? htmlspecialchars($_POST['telefone']) : '' ?>" onkeyup="handlePhone(event)" required><br>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="mb-1">
                                        <label for="" class="form-label">Data de Nascimento</label>
                                        <input name="dataNascimento" type="date" class="form-control" value="<?= isset($_POST['dataNascimento']) ? htmlspecialchars($_POST['dataNascimento']) : '' ?>" required><br>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="mb-1">
                                        <label for="crmv" class="form-label">CRMV</label>
                                        <input name="crmv" id="crmv" type="text" class="form-control" value="<?= isset($_POST['crmv']) ? htmlspecialchars($_POST['crmv']) : '' ?>" required><br>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-1">
                                        <label for="email" class="form-label">Email</label>
                                        <input name="email" id="email" type="email" class="form-control" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" required><br>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="mb-1">
                                        <label for="senha" class="form-label">Senha</label>
                                        <input name="senha" id="senha" type="password" class="form-control" value="<?= isset($_POST['senha']) ? htmlspecialchars($_POST['senha']) : '' ?>" required>
                                        <button type="button" id="togglePass" class="botao btn btn-link">Mostrar Senha</button>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-1">
                                        <label for="confirmarSenha" class="form-label">Confirmar Senha</label>
                                        <input name="confirmarSenha" id="confirmarSenha" type="password" class="form-control" value="<?= isset($_POST['confirmarSenha']) ? htmlspecialchars($_POST['confirmarSenha']) : '' ?>" required>
                                        <button type="button" id="toggleConfirmPass" class="botao btn btn-link">Mostrar Senha</button>
                                    </div>
                                </div>
                            </div>
                            <button name="salvar" type="submit" class="btn btn-primary"><i class="fa-solid fa-check"></i> Salvar</button>
                            <a href="listagemVeterinario.php" class="btn btn-warning"><i class="fa-solid fa-rotate-left"></i> Voltar</a>

                    </div>
                    <br>
                    <script>
                        //Mostrar Senha
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

                        //Mostrar Confirmar Senha
                        const confirmarSenhaInput = document.querySelector("#confirmarSenha");
                        const toggleConfirmPassButton = document.querySelector("#toggleConfirmPass");
                        toggleConfirmPassButton.addEventListener('click', toggleConfirmPass);

                        function toggleConfirmPass() {
                            if (confirmarSenhaInput.type == "password") {
                                confirmarSenhaInput.type = "text";
                                toggleConfirmPassButton.textContent = "Esconder Senha";
                            } else {
                                confirmarSenhaInput.type = "password";
                                toggleConfirmPassButton.textContent = "Mostrar Senha";
                            }
                        }

                        function validarTelefone() {
                            var telefoneInput = document.getElementById("telefone");
                            var telefone = telefoneInput.value;

                            // Expressão regular para validar o formato do telefone
                            var regex = /^\(\d{2}\) \d{4,5}-\d{4}$/;

                            if (!regex.test(telefone)) {
                                alert("Por favor, insira um número de telefone válido no formato (11) 1234-5678 ou (11) 12345-6789.");
                                telefoneInput.focus();
                                return false;
                            }

                            return true;
                        }
                    </script>


                    <!-- Requisitar a Conexão -->
                    <?php



                    if (isset($_POST['salvar'])) {

                        //2. Receber os dados para inserir no BD
                        $nome = $_POST['nomeVet'];
                        $telefone = $_POST['telefone'];
                        $dataNascimento = $_POST['dataNascimento'];
                        $email = $_POST['email'];
                        $senha = $_POST['senha'];
                        $confirmarSenha = $_POST['confirmarSenha'];
                        $crmv = $_POST['crmv'];

                        if ($confirmarSenha != $senha) {
                            $mensagem = "As senhas não coincidem, tente novamente";
                        } else if (strtotime($dataNascimento) > time()) {
                            // Data de nascimento é no futuro, mostrar mensagem de erro
                            $mensagem = "Data de nascimento não pode ser no futuro";
                        } else {
                            //3. Preparar a SQL
                            $sql = "insert into usuarioSistema (nome, telefone, dataNascimento, email, senha, CRMV, funcao) values ('$nome', '$telefone', '$dataNascimento', '$email', '$senha', '$crmv', 'Veterinario')";

                            //4. Executar a SQL
                            $resultado = mysqli_query($conexao, $sql);

                            //5. Verificar o resultado da inserção
                            if ($resultado) {
                                // Inserção bem-sucedida
                                $mensagem = "Inserido com Sucesso";
                            } else {
                                // Erro na inserção
                                $mensagem = "Erro ao inserir no banco de dados: " . mysqli_error($conexao);
                            }
                        }
                    }
                    ?>
                    <?php if (isset($mensagem)) { ?>
                        <div class="alert <?= strpos($mensagem, 'Sucesso') !== false ? 'alert-success' : 'alert-danger' ?> mb-2" role="alert">
                            <i class="fa-solid <?= strpos($mensagem, 'Sucesso') !== false ? 'fa-check' : 'fa-x' ?>" style="color: <?= strpos($mensagem, 'Sucesso') !== false ? '#12972c' : '#b70b0b' ?>;"></i>
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