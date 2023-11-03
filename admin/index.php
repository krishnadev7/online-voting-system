<?php
    require_once('includes/header.php');
    require_once('includes/navigation.php')
?>
    <?php
        if(isset($_GET['homePage'])){
            require_once("./includes/homepage.php");
        }else if(isset($_GET['addElections'])){
            require_once("./includes/add_elections.php");
        }
        else if(isset($_GET['addCandidate'])){
            require_once("./includes/add_candidate.php");
        }
        else if(isset($_GET['viewResult'])){
            require_once("./includes/viewResults.php");
        }
    ?>
<?php
    require_once('includes/footer.php');
?>