<?php
if (isset($_GET['csrf_token'])){// test for CSRF token
    $sessionCsrfToken = $_SESSION['csrf_token'];//store CSRF token from session
    $urlCsrfToken = $_GET['csrf_token'];//fetch CSRF token from url
    //echo($sessionCsrfToken) ;
    //echo"<br>";
    //echo($urlCsrfToken) ;
    if ($sessionCsrfToken == $urlCsrfToken) { //test if both token are the same ?>
        <h1 class="text-center mt-5">Bienvenue</h1>
        <p class="text-center mt-5">
            
            <?= isset($_SESSION['email']) ? $_SESSION['email'] : '' ;?>
        </p>
        <?php }else{//if not display a warning  ?> <h1 class="text-center mt-5">Erreur utilisateur non autorisé</h1> <?php }
        include("controler/logout.php");
}else{ }

?>

