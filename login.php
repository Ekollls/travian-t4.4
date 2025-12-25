<?php

//error_reporting(0);
include("application/Account.php");

if(isset($_GET['del_cookie'])) {
	setcookie("COOKUSR","",time()-3600*24,"/login.php");
	setcookie("PW","",time()-3600*24,"/login.php");
	header("Location: login.php");
    exit();
}

if(!isset($_COOKIE['COOKUSR'])) {
	$_COOKIE['COOKUSR'] = "";
}
if(!isset($_COOKIE['PW'])) {
	$_COOKIE['PW'] = "";
}

?>


<?php include("application/views/html.php");?>

<body class="v35 webkit <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> ar-AE login  perspectiveBuildings <?php echo DIRECTION; ?> season- buildingsV1">
<div id="background">
    
    <div id="bodyWrapper">
        <img style="filter:chroma();" src="img/x.gif" id="msfilter" alt=""/>
        <div id="header">
            <div id="mtop">
                <a id="logo" href="<?php echo HOMEPAGE; ?>" target="_blank" title="<?php echo SERVER_NAME; ?>"></a>
                <div class="clear"></div>
            </div>
        </div>
        <div id="center">
            <?php include('application/views/menu.php');?>
            <div id="contentOuterContainer" class="size1">
                <div class="contentTitle">&nbsp;</div>
                <div class="contentContainer">
                    <div id="content" class="login">
                        <h1 class="titleInHeader"><?=SIGN6?></h1>
                        <script type="text/javascript">
                            Element.implement({
                                //imgid: falls zu dem link ein pfeil gehört kann dieser "auf/zugeklappt" werden
                                showOrHide: function(imgid) {
                                    //einblenden
                                    if (this.getStyle('display') == 'none'){
                                        if (imgid != ''){
                                            $(imgid).className = 'open';
                                        }
                                    }
                                    //ausblenden
                                    else {
                                        if (imgid != '') {
                                            $(imgid).className = 'close';
                                        }
                                    }
                                    this.toggleClass('hide');
                                }
                            });
                        </script>
                        <?php
                        $loginform = '';
                        $startin = '';
                        if(OPENING > time()){
                            $loginform = "hide";
                        }else{ $startin = "hide"; }
                        ?>
                        <script type="text/javascript">
                            Element.implement({
                                //imgid: falls zu dem link ein pfeil gehört kann dieser "auf/zugeklappt" werden
                                showOrHide: function(imgid) {
                                    //einblenden
                                    if (this.getStyle('display') == 'none'){
                                        if (imgid != ''){
                                            $(imgid).className = 'open';
                                        }
                                    }
                                    //ausblenden
                                    else{
                                        if (imgid != ''){
                                            $(imgid).className = 'close';
                                        }
                                    }
                                    this.toggleClass('hide');
                                }
                            });
                        </script>
                                            <div class="worldStartInfo <?php echo $startin; ?>" id="worldStartInfo">
                        <?php echo LOGIN_SERVER_START; ?>
                        <script language="JavaScript">
                            dthen = <?php echo OPENING; ?>; var dnow = <?php echo time()?>; CountActive = true; CountStepper = -1; LeadingZero = true; DisplayFormat = "%%D%% <?php echo DAYS;?> + %%H%%:%%M%%:%%S%% <?php echo HRS;?>";
                            FinishMessage = "<?php echo STARTNOW;?>";

                            function calcage(secs, num1, num2) {
                                s = ((Math.floor(secs/num1))%num2).toString();
                                if (LeadingZero && s.length < 2) s = "0" + s;
                                return "" + s + "";
                            }

                            function CountBack(secs) {
                                if (secs < 0) { document.getElementById("worldStartInfo").innerHTML = "<a href='login.php'>"+FinishMessage+'</a>'; return; }
                                DisplayStr = DisplayFormat.replace(/%%D%%/g, calcage(secs,86400,100000));
                                DisplayStr = DisplayStr.replace(/%%H%%/g, calcage(secs,3600,24));
                                DisplayStr = DisplayStr.replace(/%%M%%/g, calcage(secs,60,60));
                                DisplayStr = DisplayStr.replace(/%%S%%/g, calcage(secs,1,60));

                                document.getElementById("gameStartInfo").innerHTML = DisplayStr;
                                if (CountActive) setTimeout("CountBack(" + (secs+CountStepper) + ")", SetTimeOutPeriod);
                            }

                            function putspan(backcolor, forecolor) { document.write("<div class='countdownContent' id='gameStartInfo'></div>");}

                            if (typeof(BackColor)=="undefined") BackColor = "white";
                            if (typeof(ForeColor)=="undefined") ForeColor= "black";

                            CountStepper = Math.ceil(CountStepper);
                            if (CountStepper == 0)
                                CountActive = false;
                            var SetTimeOutPeriod = (Math.abs(CountStepper)-1)*1000 + 990;
                            putspan(BackColor, ForeColor);
                            var dnow = <?php echo time()?>;
                            if(CountStepper>0)
                                ddiff = new Date(dnow-dthen);
                            else
                                ddiff = new Date(dthen-dnow);
                            gsecs = Math.floor(ddiff);
                            CountBack(gsecs);
                        </script>


                    </div>

                        <div class="outerLoginBox <?php echo @$loginform; ?>">
                            <h2><?php echo $lang['login']['Welcome'].' '; echo SERVER_NAME.' '; ?></h2>
                            <noscript>
                                <div class="noJavaScript"><?php echo LOGIN_NO_JAVASCRIPT; ?></div>
                            </noscript>




                            <div class="innerLoginBox">
                                <form method="post" name="snd" action="login.php" class="<?php echo @$loginform; ?>">
                                    <input type="hidden" name="ft" value="a4" />
                                    
                                    <table class="transparent loginTable">
                                        <tbody>
                                        <tr class="account">
                                            <td class="accountNameOrEmailAddress"><?php echo $lang['login']['Username']; ?>:</td>
                                            <td><input class="text" type="text" name="user" maxlength="35" autocomplete='off' /> <span class="error"> <?php echo $form->getError("user"); ?></span></td>
                                            <!--<div class="error <?php echo DIRECTION; ?>"><?php echo $form->getError("user"); ?></div>-->


                                        </tr>
                                        <tr class="pass">
                                           <td> <?php echo $lang['login']['Password']; ?>:</td>
											<td><input class="text" type="password" name="pw" maxlength="20" autocomplete='off' /> 
                                            <span class="error"><br><?php echo $form->getError("pw"); ?></span></td>
                                            <!--<div class="error <?php echo DIRECTION; ?>"><?php echo $form->getError("pw"); ?></div>-->


                                        </tr>

                                        <tr class="lowResOption">
                                                            <td><?php echo $lang['login']['Notice1']; ?> </td>
                                                            <td colspan="2">
                                                                <input type="checkbox" class="checkbox" id="lowRes" name="lowRes" value="">
                                                                <label for="lowRes"><?php echo $lang['login']['Notice2']; ?></label>
                                                            </td>
                                                        </tr>
                                        <tr class="lowResInfo">
                                        <td colspan="3"><?php echo $lang['login']['Notice3']; ?></td>
                </tr>

                                        <tr>
                                            <td>
                                            </td>
                                            <td>
                                        <button type="submit" value="<?php echo $lang['login']['Login']; ?>" name="s2" id="s2" class="green " onclick="document.login.w.value=screen.width+':'+screen.height;">
                                            <div class="button-container addHoverClick ">
                                                <div class="button-background">
                                                    <div class="buttonStart">
                                                        <div class="buttonEnd">
                                                            <div class="buttonMiddle"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="button-content"><?php echo $lang['login']['Login']; ?></div>
                                            </div>
                                        </button>

                                        </td>
                                        </tr>
                                        </tbody>
                                        </table>
                                        </form>
                                        <?php //} ?>
                                </div>
                            </div>

                            <div class="clear"></div>
                        <div class="greenbox passwordForgotten">
                            <div class="greenbox-top"></div>
                            <div class="greenbox-content">
                                <div class="passwordForgottenLink">
                                    <a onClick="$('showPasswordForgotten').showOrHide('arrow');" href="<?php if(isset($_GET['action'])){ echo'#'; }else{ echo'?action=forgotPassword'; }?>" class="showPWForgottenLink">
                                        <img class="close" id="arrow" src="img/x.gif"><?php echo $lang['login']['ForgetPW1']; ?>
                                    </a>
                                </div>
                                <div class="showPasswordForgotten <?php if(isset($_GET['action']) && $_GET['action']=='forgotPassword'){}else{ echo'hide'; }?>" id="showPasswordForgotten">
                                    <?php if(isset($_GET['finish'])){ ?>
                                        <font color="#008000"><?php echo LOGIN_PW_SENT; ?></font>
                                    <?php }else{ ?>
                                        <form method="post">
                                            <input type="hidden" name="forgotPassword" value="1">
                                            <div class="forgotPasswordDescription"><?php echo $lang['login']['ForgetPW2']; ?></div>
                                            <table class="transparent pwForgottenTable" id="pw_forgotten_form" cellpadding="0" cellspacing="0">
                                                <tbody>
                                                <tr class="mail">
                                                    <th><?php echo $lang['login']['ForgetPW3']; ?></th>
                                                    <td>
                                                        <input class="text" type="text" name="pw_email" value=""><br><div class="error <?php echo DIRECTION; ?>"><?php echo $form->getError("pw_email"); ?></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td colspan="2">
                                                        <button type="submit" value="<?php echo $lang['login']['ForgetPW4']; ?>" name="s2" id="s2" class="green " onclick="document.login.w.value=screen.width+':'+screen.height;">
                                                            <div class="button-container addHoverClick ">
                                                                <div class="button-background">
                                                                    <div class="buttonStart">
                                                                        <div class="buttonEnd">
                                                                            <div class="buttonMiddle"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="button-content"><?php echo $lang['login']['ForgetPW4']; ?></div>
                                                            </div>
                                                        </button>

                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </form>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="greenbox-bottom"></div>
                            <div class="clear"></div>
                        </div>
                        </div>
                    
                    <div class="clear">&nbsp;</div>
                
                </div>
                
                <div class="clear"></div>

            <div class="contentFooter">&nbsp;</div>
        </div>
        
        </div>
        
<?php include("application/views/footer.php");?>
    </div>


<div id="ce"></div>

</body>
</html>
