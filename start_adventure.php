<?php 
    /*
        By iRedux - https://www.facebook.com/opito8
    */
    require_once("application/Account.php");
    require_once("application/views/html.php");

    // Page Data
    $pData = array('CClass' => 'hero_adventure', 'HTitle' => $lang['Hero']['adv00']);
    require_once("application/views/main/Top.php");
    require_once("application/views/Attack/adventure.php");
    require_once("application/views/main/Footer.php");
?>
