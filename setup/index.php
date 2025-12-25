<?php 
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

session_start();
include("templates/script.tpl");
header('Content-Type: text/html; charset=UTF-8');
if(!isset($_GET['s'])) {
	$_GET['s']=0;
}
if(isset($_GET['lang']) && in_array($_GET['lang'], array('ar','en'))){
    $_SESSION['ilang'] = $_GET['lang'];
    //header('Location: ')
}

include("../application/Lang/".($_SESSION['ilang'] ? $_SESSION['ilang'] : 'en')."/Lang.php");


?>


<!DOCTYPE html>
<html>
<head>
    <title>Install script</title>
    <link rel="shortcut icon" href="../favicon.ico"/>
    <link href="../gpack/lang/en/compact.css" rel="stylesheet" type="text/css" />

    <script src="http://www.cy-pr.com/tools/time/time.js" type="text/javascript"></script>
</head>
<style>h1 {

        font-family: monotype corsiva, Helvetica, sans-serif;
        color:#a40020;
font-size: 40px;
    }</style>
<body class="v35 webkit login ar-AE login perspectiveBuildings <?php echo DIRECTION; ?> season- buildingsV3">

<div id="background">
    <div id="headerBar"></div>
    <div id="bodyWrapper">



        <div id="header">
            <?php
            if(isset($_GET['lang'])){

                if(count($_GET)==1){
                    $_SERVER['QUERY_STRING']= preg_replace('/lang='.$_GET['lang'].'/','',$_SERVER['QUERY_STRING']);
                }else{
                    $_SERVER['QUERY_STRING']= preg_replace('/&lang='.$_GET['lang'].'/','',$_SERVER['QUERY_STRING']);
                }
            }
            if(count($_GET) && isset($_GET['lang'])){
                if($_GET['lang']!='en'){
                    $linken='?'.$_SERVER['QUERY_STRING'].'&lang=en';
                }else{$linken='?'.$_SERVER['QUERY_STRING'];}
                if($_GET['lang']!='ru'){
                    $linkru='?'.$_SERVER['QUERY_STRING'].'&lang=ru';
                }else{$linkru='?'.$_SERVER['QUERY_STRING'];}
            }elseif(!count($_GET)){
                $linkru='?lang=ru';
                $linken='?lang=en';
            }else{
                $linkru='?'.$_SERVER['QUERY_STRING'].'&lang=ru';
                $linken='?'.$_SERVER['QUERY_STRING'].'&lang=en';

            }


            ?>

        </div>
        <div id="center" style="float:none">





            <center>
                <div class="headline">
                    <span class="f18 c5" ><h1>Install script</h1></span></div>
<br />
               <div id="contentOuterContainer" style="float:none;padding:10rem;padding-top:0" >
               <div class="contentTitle">
                   				</div>
               <div class="contentContainer" style="padding:50px;padding-top:0">

<br />
					<?php
					IHG_Progressbar::draw_css();
					$bar = new IHG_Progressbar(7, 'step %d From %d ');
					$bar->draw();
					for($i = 0; $i < ($_GET['s']+1); $i++) {
						$bar->tick();
					}
					?>


				<?php
				if(substr(sprintf('%o', fileperms('../')), -4)<'700'){
					echo"<span class='f18 c5'>ERROR!</span><br />It's not possible to write the config file. Change the permission to '777'. After that, refresh this page!";
				} else
					switch($_GET['s']){
						case 0:
                            include("templates/greet.tpl");break;
                        case 1:
						include("templates/config.tpl");
						break;
						case 2:
						include("templates/dataform.tpl");
						break;
						case 3:
						include("templates/field.tpl");

						break;
						case 4:
                            include("templates/multihunter.tpl");

                            break;
						case 5:

						include("templates/oasis.tpl");
						break;
						case 6:
						include("templates/end.tpl");
						break;
                    }
				?>

               </div>
               <div class="clear">&nbsp;</div>

               <div class="contentFooter"></div>
        </center>
            <div class="clear"></div>
        </div>

                </div>
                <div id="ce"></div>


</body>
</html>
