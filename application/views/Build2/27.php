    <div id="build" class="gid27">
<?php
        if(isset($_GET['show'])){  include("27_show.php");  }else{
        if(!isset($_GET['t'])){
            include("27_1.php");
        }elseif(isset($_GET['t']) && $_GET['t'] == 2){
            include("27_2.php");
        }elseif(isset($_GET['t']) && $_GET['t'] == 3){
            include("27_3.php");
        }elseif(isset($_GET['t']) && $_GET['t'] == 5){
            include("27_5.php");
    }
    }

        
        ?>
    </div>