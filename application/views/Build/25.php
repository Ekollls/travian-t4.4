<?php


//include("25_menu.php");
if(!isset($_GET['t']) || !in_array($_GET['t'],array(1,2,3,4))){
    if ($village->capital == 1) {
        echo "<p class=\"act\">".RE2."</p>";
    }
    if($village->resarray['f'.$id] >= 10){
        include("25_train.php");
    }
    else{
        echo '<div class="c"></div>';
    }
}else{
    include("application/views/Build/".$village->resarray['f'.$_GET['id'].'t']."_".$_GET['t'].".php");
}


?>
