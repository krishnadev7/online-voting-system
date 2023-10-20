<?php
    session_start();
    require_once('../admin/includes/config.php');

    if($_SESSION['key'] != 'VotersKey'){
        echo "<script>location.assign('../admin/logout.php');</script>";
        die;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voters Panel - Online voting system</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    
<div class="container-fluid " style="background-color: black;">
    <div class="row   text-white" >
        <div class="col-1">
            <img src="../assets/images/vote-logo.jpg" alt="vote-logo" width="80px" />
        </div>
        <div class="col-11 my-auto">
            <h3>ONLINE VOTING SYSTEM - <small>Welcome <?php echo $_SESSION['email_id']?></small></h3>
        </div>
    </div>
</div>
