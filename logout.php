<?php
include("application/Account.php");

?>


<?php include("application/views/html.php");?>

<body class="v35 webkit <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> ar-AE logout <?php if($dorf1==''){echo 'perspectiveBuildings';}else{ echo 'perspectiveResources';} ?> <?php echo DIRECTION; ?> buildingsV1">
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
                    <div id="content" class="logout">
                        <h1 class="titleInHeader"><?php echo LOGOUT_TITLE; ?></h1>
                        <h4><?php echo LOGOUT_H4; ?></h4>
                        <p><?php echo LOGOUT_DESC; ?></p>
                        <p><a class="arrow" href="login.php?del_cookie"><?php echo LOGOUT_LINK;?></a></p>

                        <div class="greenbox cf relogin">
	<div class="greenbox-top"></div>
	<div class="greenbox-content">
		<h5><?php echo $lang['Logout']['01']; ?></h5>

		<form name="snd" method="post" action="login.php">
        <input type="hidden" name="ft" value="a4" />
			<table class="transparent reloginTable">
				<tbody><tr class="account">
					<th class="accountName">
                    <?php echo $lang['Logout']['02']; ?> :
					</th>
					<td>
						<input type="text" name="user" value="<?php echo $_SESSION['logoutU']; ?>" class="text"><br>
					</td>
				</tr>
				<tr class="pass">
					<th>
                    <?php echo $lang['Logout']['03']; ?> :                    </th>
					<td>
						<input type="password" maxlength="20" name="pw" value="" class="text"><br>
					</td>
				</tr>
			</tbody></table>
                <div class="submitButton">
                    <button type="submit" value="<?php echo $lang['Logout']['04']; ?>" name="s1" id="reloginButton" class="green " onclick="document.login.w.value=screen.width+':'+screen.height;">
                        <div class="button-container addHoverClick ">
                            <div class="button-background">
                                <div class="buttonStart">
                                    <div class="buttonEnd">
                                        <div class="buttonMiddle"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-content"><?php echo $lang['Logout']['04']; ?></div>
                        </div>
                    </button>
                </div>
                <input type="hidden" name="w" value="">
                <input type="hidden" name="login" value="1593801796">
                        </form>
        </div>
        <div class="greenbox-bottom"></div>
    </div>

                    </div>
                    <div class="clear">&nbsp;</div>
                </div>
                <div class="clear"></div>

                <div class="contentFooter">&nbsp;</div>
            </div>
        </div>
<?php include('application/views/footer.php');?>

    </div>

    <div id="ce"></div>

</body>
</html>