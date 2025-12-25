<?php
include('application/Account.php');

if(!empty($_GET['ref'])){$inviter=$database->filterstringvalue($_GET['ref']);}

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
                    <div id="content" class="signup"><h1 class="titleInHeader"><?php echo REG; ?></h1>
                        <?php if($_SESSION['isOkay']){ ?><b style="color:blue;"><?php echo $_SESSION['isOkay']; ?></b><br><br><?php } ?>
                        <?php if($database->config()['regstatus']){ ?>
                        <h4 class="round"><?php echo REGISTER_USERINFO; ?></h4>
                        <form name="snd" method="post" action="anmelden.php">
                            <input type="hidden" name="ft" value="a1" />
                            <table cellpadding="0" cellspacing="0" align="center">
                                <tbody>
                                <!--<tr class="top">
                                    <th><?php echo INVITED; ?></th>
                                    <td><input class="text" type="text" name="referal"  value="<?php if(!empty($inviter) && is_numeric($inviter)){echo $database->getUserField($inviter,'username',0); }elseif(!empty($inviter) && !is_numeric($inviter)){
                                            echo $inviter;
                                        } ?>" maxlength="15"  />
                                    </td>
                                </tr>-->

                                <th><?php echo NICKNAME; ?></th>
                                <td><input class="text" type="text" name="name" placeholder="<?=anlm0?>" value="<?php echo $form->getValue('name'); ?>" maxlength="15" />
                                    <span class="error"><?php echo $form->getError('name'); ?></span>
                                </td>

                                <tr>
                                    <th><?php echo EMAIL; ?></th>
                                    <td>
                                        <input class="text" type="text"  placeholder="<?=anlm1?>"  name="email" value="<?php echo stripslashes($form->getValue('email')); ?>" />
                                        <span class="error"><?php echo $form->getError('email'); ?></span>
                                    </td>
                                </tr>
                                <tr class="btm">
                                    <th><?php echo PASSWORD; ?></th>
                                    <td>
                                        <input class="text" type="password"  placeholder="<?=anlm2?>" name="pw" value="<?php echo stripslashes($form->getValue('pw')); ?>" maxlength="30" />
                                        <span class="error"><?php echo $form->getError('pw'); ?></span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <br>
                            <h4 class="round"><?php echo REGISTER_MOREINFO; ?></h4>
                            <div class="checks">
                                <input class="check" type="checkbox" id="agb" name="agb" value="1" <?php echo $form->getRadio('agb',1); ?>/>
                                <label for="agb"><?php echo ACCEPT_RULES; ?></label>
                            </div>
                            <br>
                            <div class="btn">
                                <input type="hidden" name="vid" value="0">
                                <input type="hidden" name="kid" value="0">
                                <button type="submit" value="anmelden" name="s1" class="green "  id="btn_signup" title="Register">
                                    <div class="button-container addHoverClick ">
                                        <div class="button-background">
                                            <div class="buttonStart">
                                                <div class="buttonEnd">
                                                    <div class="buttonMiddle"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="button-content"><?php echo REG; ?></div>
                                    </div>
                                </button>
                            </div>
                        </form>
                        <?php }else{ ?>
                            Logging is closed in a this server.
                        <?php } ?>
                        <div class="clear">&nbsp;</div>

                    </div>
                    <div class="clear"></div>
                </div>
                <div class="contentFooter">&nbsp;</div>
            </div>

        </div>


    </div>
    <div id="ce"></div></div></div></div>

</body>
</html>
