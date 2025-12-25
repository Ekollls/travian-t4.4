<?php
if(isset($_GET['lang'])){

    if(count($_GET)==1){
        $_SERVER['QUERY_STRING']= preg_replace('/lang='.$_GET['lang'].'/','',$_SERVER['QUERY_STRING']);
    }else{
        $_SERVER['QUERY_STRING']= preg_replace('/&lang='.$_GET['lang'].'/','',$_SERVER['QUERY_STRING']);
    }
}
if(count($_GET) && isset($_GET['lang'])){
    if($_GET['lang']!='ru'){
        $linken='?'.$_SERVER['QUERY_STRING'].'&lang=ru';
    }else{$linken='?'.$_SERVER['QUERY_STRING'];}
    if($_GET['lang']!='ru'){
        $linkru='?'.$_SERVER['QUERY_STRING'].'&lang=ru';
    }else{$linkru='?'.$_SERVER['QUERY_STRING'];}
}elseif(!count($_GET)){
    $linkru='?lang=ru';
    $linken='?lang=ru';
}else{
    $linkru='?'.$_SERVER['QUERY_STRING'].'&lang=ru';
    $linken='?'.$_SERVER['QUERY_STRING'].'&lang=ru';

}


?>
<div id="sidebarBeforeContent" class="sidebar beforeContent">
    <div id="sidebarBoxMenu" class="sidebarBox   ">
        <div class="sidebarBoxBaseBox">
            <div class="baseBox baseBoxTop">
                <div class="baseBox baseBoxBottom">
                    <div class="baseBox baseBoxCenter"></div>
                </div>
            </div>
        </div>
        <div class="sidebarBoxInnerBox">
            <div class="innerBox header noHeader">
            </div>
            <div class="innerBox content">
                <ul>
                    <li class="first"><a href="<?=HOMEPAGE;?>" target="_blank"><?=HOME?></a></li>
                    <li <?php   if(basename($_SERVER['PHP_SELF']) == "login.php") { echo ' class="active"'; } ?>>
                        <a href="login.php"><?=SIGN6?></a>
                    </li>

                    <li <?php   if(in_array(basename($_SERVER['PHP_SELF']), array('anmelden.php', 'activate.php'))) { echo ' class="active"'; } ?> >
                        <a href="anmelden.php"><?=SIGN5?></a>
                    </li>
                   
                    <li><a href="#"><?=FORUM;?></a></li>
                   
                    <li <?php if(basename($_SERVER['PHP_SELF']) == "support.php") { echo ' class="active"'; } ?> >
                        <a href="support.php"><?=SUPPORT;?></a>
                    </li>
                   


                </ul>		</div>
            <div class="innerBox footer">
            </div>
        </div>
    </div>												<div class="clear"></div>
</div>