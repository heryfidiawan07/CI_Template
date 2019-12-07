<!DOCTYPE>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">
    
    <title><?= $title; ?></title>

    <!-- CDN -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet"> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> -->
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="<?= base_url().'assets/fontawesome/css/all.css'; ?>">

    <link href="<?= base_url().'storage/assets/img/icon.png'; ?>" rel='shortcut icon'>

    <!-- JQuery CDN -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> -->
    <script src="<?= base_url().'assets/js/jquery.3.4.1.min.js';?>"></script>

    <!-- Bootstrap CDN -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?= base_url().'assets/bootstrap/css/bootstrap.min.css'; ?>">
    <link rel="stylesheet" href="<?= base_url().'assets/css/animate.css'; ?>">

    <!-- DataTable CDN -->
    <!-- <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script> -->
    <script src="<?= base_url().'assets/datatables/js/dataTables.1.10.18.js'; ?>"></script>

    <!-- DataTable Bootstrap CDN JS -->
    <!-- <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script> -->
    <script src="<?= base_url().'assets/datatables/js/dataTables.bootstrap4.min.js'; ?>"></script>

    <!-- DataTbale Bootstrap CSS -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"> -->
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/datatables/css/dataTables.bootstrap4.min.css'; ?>">

    <!-- Dashboard CSS -->
    <link rel="stylesheet" href="<?= base_url().'assets/css/dashboard.css'; ?>">
    <link rel="stylesheet" href="<?= base_url().'assets/css/sidebar.css'; ?>">
    <link rel="stylesheet" href="<?= base_url().'assets/css/left-right-sidebar.css'; ?>">

    <!-- Chart.JS -->
    <link rel="stylesheet" href="<?= base_url().'assets/css/chart.css'; ?>">
    
    <!-- DatePicker -->
    <link rel="stylesheet" href="<?= base_url().'assets/css/jquery-ui.css'; ?>">
    <script src="<?= base_url().'assets/js/jquery-ui.js'; ?>"></script>
    <script>
        $( function() {
            $( ".datepicker" ).datepicker();
        });
    </script>

</head>
<body>

    <div class="wrapper">

        <?php $this->load->view('/template/sidebar.php'); ?>

        <!-- Page Content  -->
        <div id="content">
            
            <?php $this->load->view('/template/navbar.php'); ?>

            <div id="notification" role="alert" style="position: fixed; top: 100px; right: 0; margin-right: 50px; z-index: 100;"></div>
