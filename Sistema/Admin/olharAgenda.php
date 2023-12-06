<?php
//1. Conectar no BD (IP, usuario, senha, nome do banco)
require_once("verificaAutenticacao.php");
require_once("conexao.php");
//Busca o usuário selecionado pelo usuarioListar.php
$sql = "select * from agenda where id = " . $_GET['id'];
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

    <title>Visualizar Agenda</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <script src="https://kit.fontawesome.com/0215a38eba.js" crossorigin="anonymous"></script>
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/favicon1.png" type="image/x-icon" />
    <!--Paw icon by <a target="_blank" href="https://icons8.com">Icons8</a> -->

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
                    <!-- Editar a Agenda -->
                    <div class="container">
                        <h1 class="mb-4"><i class="fa-solid fa-eye"></i> Visualizar Agenda</h1>
                        <form method="post">
                            <input type="hidden" name="id" value="<?= $linha['id'] ?>">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-1">
                                        <label for="formGroupExampleInput" class="form-label">Cliente</label>
                                        <select disabled class="custom-select" aria-label="Disabled select example" disabled>
                                            <?php
                                            $pet_id = $linha['pet_id'];
                                            $sql = "SELECT pet.*, cliente.nome AS nome_cliente 
                                            FROM pet
                                            INNER JOIN cliente ON pet.cliente_id = cliente.id
                                            WHERE pet.id = '$pet_id'";
                                            $resultado = mysqli_query($conexao, $sql);

                                            if ($resultado) {
                                                $dados_pet = mysqli_fetch_assoc($resultado);

                                                // Agora você pode acessar o nome do cliente usando $dados_pet['nome_cliente']
                                                $nome_cliente = $dados_pet['nome_cliente'];

                                                // Outros dados do pet
                                                $nome_pet = $dados_pet['nome'];

                                                echo "<option>{$nome_cliente}</option>";
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-1">
                                        <label for="formGroupExampleInput" class="form-label">Pet</label>
                                        <select class="custom-select" aria-label="Disabled select example" disabled>
                                            <?php echo "<option>{$nome_pet}</option>"; ?>
                                        </select>
                                    </div>
                                </div>
                            </div> <br>
                            <div class="row">
                                <div class="col-3">
                                    <div class="mb-1">
                                        <label for="formGroupExampleInput" class="form-label">Data</label>
                                        <input disabled name="data" type="date" class="form-control" value="<?= $linha['data'] ?>" disabled><br>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-1">
                                        <label for="formGroupExampleInput" class="form-label">Hora</label>
                                        <select disabled name="hora" class="custom-select" disabled>
                                            <option value="08:00" <?php echo ($linha['hora'] == '08:00') ? 'selected' : ''; ?>>08:00</option>
                                            <option value="08:30" <?php echo ($linha['hora'] == '08:30') ? 'selected' : ''; ?>>08:30</option>
                                            <option value="09:00" <?php echo ($linha['hora'] == '09:00') ? 'selected' : ''; ?>>09:00</option>
                                            <option value="09:30" <?php echo ($linha['hora'] == '09:30') ? 'selected' : ''; ?>>09:30</option>
                                            <option value="10:00" <?php echo ($linha['hora'] == '10:00') ? 'selected' : ''; ?>>10:00</option>
                                            <option value="10:30" <?php echo ($linha['hora'] == '10:30') ? 'selected' : ''; ?>>10:30</option>
                                            <option value="11:00" <?php echo ($linha['hora'] == '11:00') ? 'selected' : ''; ?>>11:00</option>
                                            <option value="11:30" <?php echo ($linha['hora'] == '11:30') ? 'selected' : ''; ?>>11:30</option>
                                            <option value="14:00" <?php echo ($linha['hora'] == '14:00') ? 'selected' : ''; ?>>14:00</option>
                                            <option value="14:30" <?php echo ($linha['hora'] == '14:30') ? 'selected' : ''; ?>>14:30</option>
                                            <option value="15:00" <?php echo ($linha['hora'] == '15:00') ? 'selected' : ''; ?>>15:00</option>
                                            <option value="15:30" <?php echo ($linha['hora'] == '15:30') ? 'selected' : ''; ?>>15:30</option>
                                            <option value="16:00" <?php echo ($linha['hora'] == '16:00') ? 'selected' : ''; ?>>16:00</option>
                                            <option value="16:30" <?php echo ($linha['hora'] == '16:30') ? 'selected' : ''; ?>>16:30</option>
                                            <option value="17:00" <?php echo ($linha['hora'] == '17:00') ? 'selected' : ''; ?>>17:00</option>
                                            <option value="17:30" <?php echo ($linha['hora'] == '17:30') ? 'selected' : ''; ?>>17:30</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-1">
                                        <label for="procedimento_id" class="form-label">Procedimento</label>
                                        <select disabled name="procedimento_id" class="custom-select " disabled>
                                            <?php
                                            $sql = "SELECT * FROM procedimento WHERE statusProcedimento = 'Ativo' ORDER BY nome";
                                            $resultado = mysqli_query($conexao, $sql);

                                            while ($linhaPR = mysqli_fetch_array($resultado)) {
                                                $idPr = $linhaPR['id'];
                                                $nome = $linhaPR['nome'];

                                                $selecionado = ($linha['procedimento_id'] == $idPr) ? "selected" : "";

                                                echo "<option value='{$idPr}' {$selecionado}>{$nome}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-1">
                                        <label disabled for="formGroupExampleInput" class="form-label">OBS</label>
                                        <textarea name="obs" type="text" class="form-control" disabled><?= $linha['obs'] ?></textarea> <br>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="mb-1">
                                        <label for="formGroupExampleInput" class="form-label">Resultado</label>
                                        <textarea disabled name="resultado" id="campoResultado" class="form-control" disabled><?= $linha['resultado'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="veterinario_id" class="form-label">Veterinário</label>
                                    <select disabled name="veterinario_id" class="custom-select " disabled>
                                        <?php
                                        $sql = "select * from veterinario order by nome";
                                        $resultado = mysqli_query($conexao, $sql);

                                        while ($linhaVT = mysqli_fetch_array($resultado)) {
                                            $idVet = $linhaVT['id'];
                                            $nome = $linhaVT['nome'];

                                            $selecionado = ($linha['veterinario_id'] == $idVet) ? "selected" : "";

                                            echo "<option value='{$idVet}' {$selecionado}>{$nome}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-6">
                                <div class="mb-1">
                                        <label for="formGroupExampleInput" class="form-label"> Status</label>
                                        <textarea disabled class="form-control" disabled><?= $linha['statusAgenda'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <br>
                    <center><a href="listagemAgenda.php" class="btn btn-warning"><i class="fa-solid fa-rotate-left"></i>Voltar</a></center>

                    </form><br>
                    <?php
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