<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

if(!isset($_SESSION['customer'])){
    header('Location: login.php');
    exit;
}

$namauser = $_SESSION['customer']['name'];
$iduser = $_SESSION['customer']['id'];
require 'function.php';


// Data Tagihan User
$cek = query("SELECT * FROM monthly_bill WHERE id_users = '$iduser' ORDER BY date DESC limit 1 ");

if (isset($_POST['btn_bayar'])) {
    
    $bulanke = date("Y-m-d", strtotime($_POST['month']));

    $name = $_POST['name'];
    $tagihan = $_POST['tagihan'];
    
    $ambilbulanpost = date("Y-m", strtotime($_POST['month']));
    $ambilbulansekarang = date("Y-m");

    $datedb = date('Y-m', strtotime($cek['date']));

    if($ambilbulansekarang == $datedb){
        echo "<script>alert('Anda Sudah Melakukan Pembayaran Bulanan');</script>";
        echo "<script>location='paylog.php';</script>";
    }else {
        mysqli_query($conn, "INSERT INTO monthly_bill VALUE ('','$iduser','$tagihan','$bulanke') ");
        echo "<script>alert('Berhasil Melakukan Pembayaran Bulanan');</script>";
        echo "<script>location='paylog.php';</script>";
    }

    // if ($cek) {
    //     if ($ambilbulansekarang == $cek['date']) {
    //         echo "<script>alert('Anda Sudah Melakukan Pembayaran Bulanan');</script>";
    //         echo "<script>location='paylog.php';</script>";
    //     }else {
    //         mysqli_query($conn, "INSERT INTO monthly_bill VALUE ('','$iduser','$tagihan','$bulanke') ");
    //         echo "<script>alert('Berhasil Melakukan Pembayaran Bulanan');</script>";
    //         echo "<script>location='paylog.php';</script>";
    //     }
    // }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'topbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-4">
                        <form class="" method="POST" action="">
                            <div class="form-group">
                                <label for="tagihan">Tagihan Bulanan</label>
                                <input type="number" class="form-control form-control-user"
                                    id="tagihan" name="tagihan" value="150000" readonly>
                            </div>
                            <div class="form-group">
                                <label for="name">Nama Anda</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= $namauser; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="month">Bulan ke-</label>
                                <input type="text" class="form-control" id="month" name="month" value="<?= date("Y-m-d") ?>" readonly>
                            </div>
                            <button name="btn_bayar" id="btn_bayar" class="btn btn-success btn-md">Bayar</button>
                        </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website <?= date('Y')?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


<!-- Logout Modal -->
<?php include 'logoutmodal.php';?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>