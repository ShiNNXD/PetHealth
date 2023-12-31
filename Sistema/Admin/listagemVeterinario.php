<?php
require_once("verificaAutenticacao.php");
require_once("conexao.php");

//Exclusão
if (isset($_GET['id'])) {
    $sql = "delete from veterinario where id = " . $_GET['id'];
    mysqli_query($conexao, $sql);
    $mensagem = "Exclusão realizada com sucesso.";
}

//Consulta o SQL
$sql = "SELECT * FROM veterinario";

//Executa o SQL
$resultado = mysqli_query($conexao, $sql);

if (!$resultado) {
    die('Erro na consulta SQL: ' . mysqli_error($conexao));
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Lista de Veterinários</title>

    <!-- Custom fonts for this template-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="js/javascript.js"></script>
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



                <!-- Page Heading -->
                <div>

                    <!-- Bloco de mensagem -->
                    <?php if (isset($mensagem)) { ?>
                        <div class="alert alert-success" role="alert">
                            <i class="fa-solid fa-check" style="color: #2eb413;"></i>
                            <?= $mensagem ?>
                        </div>
                    <?php } ?>
                    <!-- Tabela de listagem de veerinários -->
                    <div class="card mt-3 mb-3">
                        <div class="card-body">
                            <h2>
                                <i class="fa-solid fa-user-doctor"></i> Listagem de Veterinários
                                <a href="cadastroVeterinario.php" class="btn btn-success btn-sn">
                                    <i class="fa-solid fa-plus" style="color: #ffffff;"></i> Novo Veterinário
                                </a>
                            </h2>
                            <form method="post">
                                <div class="row mb-3 mt-4">
                                    <div class="col-3">
                                        <label for="filtroStatus">Filtrar por Status</label>
                                        <select class="custom-select" name="filtroStatus">
                                            <option value="">Todos</option>
                                            <option value="Ativo" <?= (isset($_POST['filtroStatus']) && $_POST['filtroStatus'] == 'Ativo') ? "selected" : "" ?>>Ativos</option>
                                            <option value="Inativo" <?= (isset($_POST['filtroStatus']) && $_POST['filtroStatus'] == 'Inativo') ? "selected" : "" ?>>Inativos</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary mt-3">Filtrar</button>
                                    </div>
                                    <div class="col-3">
                                        <label for="filtroNome">Buscar por Nome:</label>
                                        <input type="text" name="filtroNome" placeholder="Digite o nome" class="form-control" value="<?= (isset($_POST['filtroNome'])) ? $_POST['filtroNome'] : '' ?>">
                                    </div>
                                </div>
                                <?php
                                $filtroStatus = "";
                                $filtroNome = "";
                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                                    $filtroStatus = mysqli_real_escape_string($conexao, $_POST['filtroStatus']);
                                    $filtroNome = mysqli_real_escape_string($conexao, $_POST['filtroNome']);


                                    $filtro = "";
                                    if (isset($filtroStatus) && ($filtroStatus != '')) {
                                        $filtro .= " and statusVet = '$filtroStatus' ";
                                    }
                                    if (isset($filtroNome) && ($filtroNome != '')) {
                                        $filtro .= " and nome LIKE '%$filtroNome%' ";
                                    }

                                    $sql = "SELECT * FROM veterinario WHERE 1 = 1 {$filtro} ORDER BY nome";
                                    $resultado = mysqli_query($conexao, $sql);
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                    <?php
                    if ($resultado->num_rows > 0) {
                        // Exibir os dados em uma tabela
                    ?>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Telefone</th>
                                    <th scope="col">Sexo</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Data de Nascimento</th>
                                    <th scope="col">CRMV</th>
                                    <th scope="col">Data de Admissão</th>
                                    <th scope="col">Data de Demissão</th>
                                    <th scope="col">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = $resultado->fetch_assoc()) {
                                    $dataNascimentoFormatada = date("d/m/Y", strtotime($row["dataNascimento"]));
                                    $dataAdmissaoFormatada = date("d/m/Y", strtotime($row["dataAdmissao"]));
                                    // Verifica se a dataDemissao é diferente de '0000-00-00' e não é nula antes de formatar
                                    $dataDemissaoFormatada = ($row["dataDemissao"] && $row["dataDemissao"] != '0000-00-00') ? date("d/m/Y", strtotime($row["dataDemissao"])) : '';

                                    echo "<tr><td>" . $row["id"] . "</td><td>" . $row["statusVet"] . "</td><td>" . $row["nome"] . "</td><td>" . $row["telefone"] . "</td><td>" . $row["sexo"] . "</td><td>" . $row["email"] . "</td><td>" . $dataNascimentoFormatada . "</td><td>" . $row["CRMV"] . "</td><td>" . $dataAdmissaoFormatada . "</td><td>" . $dataDemissaoFormatada;
                                ?>
                                    <td>
                                        <a href="olharVeterinario.php?id=<?= $row['id'] ?>" class="btn btn-info"><i class="fa-solid fa-eye" style="color: #000000;"></i></a>
                                        <a href="editarVeterinario.php?id=<?= $row['id'] ?>" class="btn btn-warning"><i class="fa-solid fa-pen-to-square" style="color: #000000;"></i></a>
                                    </td>
                                    </tr>
                                <?php
                                }
                                ?>
                        </table>
                    <?php } else {
                        echo "Nenhum resultado encontrado";
                    } ?>

                </div>
                <!-- End of Main Content -->


            </div>

            <!-- End of Content Wrapper -->
        </div>

        <!-- End of Page Wrapper -->
    </div>    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Selecione "Logout" se você deseja encerrar sua sessão atual.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
</body>
</html>