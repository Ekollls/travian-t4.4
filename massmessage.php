<?php



include_once("application/Account.php");
$max_per_pass = 1000;

if ($session->access!=9) die("Hacking attemp!");

if (@$_POST['submit'] == "Send")
{
	unset ($_SESSION['m_message']); unset ($_SESSION['m_subject']); unset ($_SESSION['m_color']);
	if (!$_POST['message']){die("You have to enter message");}
	if (!$_POST['subject']){die("You have to enter subject");}
	if (!$_POST['color']){$_SESSION['m_color'] = "black";}
	$_SESSION['m_subject'] = $_POST['subject'];
	if (!$_SESSION['m_color']){$_SESSION['m_color'] = $_POST['color'];}
	$_SESSION['m_message'] = $database->RemoveXSS($_POST['message']);
	$NextStep = true;
}


if (@isset($_POST['confirm']))
{
	if ($_POST['confirm'] == 'Yes') $NextStep2 = true;
	if ($_POST['confirm'] == 'No' ) $Interupt = true;
}

$max_per_pass = 1000;

if (isset($_GET['send']) && isset($_GET['from']))
{

	$_SESSION['m_message'] = "[message]".$_SESSION['m_message']."[/message]";

	$users = $database->query("SELECT id FROM users WHERE id != 0");
foreach($users as $u){
	$sql = "INSERT INTO mdata (`target`, `owner`, `topic`, `message`, `viewed`, `send`, `time`) VALUES ";
			$sql .= "(".$u['id'].", 6, :sub, :mes, 0,  0, ".time().")";
    $p=array('sub'=>$_SESSION['m_subject'],'mes'=>"\"".$_SESSION['m_message']."\"");
	$database->query($sql,$p);
 $done = true;
}
}
?>


<?php include("application/views/html.php");?>


<body class="v35 webkit <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> ar-AE messages <?php echo DIRECTION; ?>">
<script type="text/javascript">
    window.ajaxToken = 'de3768730d5610742b5245daa67b12cd';
</script>
<div id="background">
    <div id="headerBar"></div>
    <div id="bodyWrapper">

        <div id="header">
            <div id="mtop">
                <?php
                include("application/views/topheader.php");
                include("application/views/toolbar.php");

                ?>


            </div>
        </div>
        <div id="center">
            <?php include("application/views/sideinfo.php"); ?>
            <div id="contentOuterContainer" class="size1">
                <?php include("application/views/res.php"); ?>
                <div class="contentTitle">&nbsp;</div>
                <div class="contentContainer">
                    <div id="content" class="messages">

                        <h1 class="titleInHeader"><?php echo HEADER_MESSAGES; ?></h1>
<?php if (@!$NextStep && @!$NextStep2 && @!$done){?>
<form method="POST" action="massmessage.php" name="myform" >
			<table cellspacing="1" cellpadding="1" class="tbg" style="background:#999; ">
			  <tbody>
				<tr>
				<td class="rbg" style="text-align:center;" colspan="2"><?php echo MASS; ?></td>
				
				</tr>
				<tr>
					<td colspan="1" style="text-align: left;  " ><?php echo MASS_SUBJECT; ?></td>
					<td style=" text-align: left;">
					<input type="text" style="width: 240px;" class="fm" name="subject" value="" size="30"></td>
					
				</tr>
				<tr>
				  <td style="text-align: left;"><?php echo MASS_COLOR; ?></td>
				  <td style="text-align: left;">


					<input type="text" style="width: 240px;" class="fm" name="color" size="30"></td>
				</tr>
				<tr>
				  <td colspan="2" style="text-align:center;"><?php echo MASS; ?>			        <br>
			<textarea class="fm" name="message" cols="60" rows="23"></textarea></td>
				</tr>
				<tr>
				  <td colspan="2"  style="text-align:center;"><?php echo MASS_REQUIRED; ?>
				</tr>
				<tr>
				  <td colspan="2"  style="text-align:center;">
					<input type="submit" value="Send" name="submit" />    </td>
				</tr>
			  </tbody>
			</table>
			</form>
			<?php if (@!$NextStep && @!$NextStep2 && @!$done){?>
<?php } ?>

<?php }elseif (@$NextStep){?>
<form method="POST" action="massmessage.php">
			<table cellspacing="1" cellpadding="1" class="tbg">
			  <tbody>
				<tr>
				  <td class="rbg"><?php echo MASS_CONFIRM; ?></td>
				</tr>
				<tr>
				  <td style="text-align: left; width: 200px;"><?php echo MASS_REALLY; ?></td>
				  <td style="text-align: left;">
					<input type="submit" style="width: 240px;" class="fm" name="confirm" value="Yes">
					<input type="submit" style="width: 240px;" class="fm" name="confirm" value="No"></td>
				</tr>
			  </tbody>
			</table>
</form>
<?php }elseif (@$NextStep2){?>
<script>document.location.href='massmessage.php?send=true&from=0'</script>

<?php }elseif (@$Interupt){?>
<b><?php echo MASS_ABORT; ?></b>

<?php }elseif (@$done){?>
<?php echo MASS_SENT; ?>
<?php }else{die("Something is wrong");}?>
                        <div id="map_details">



                            <div class="clear"></div>

                        </div>

                        <div class="clear"></div>

                        <div class="clear">&nbsp;</div>							</div>							<div class="clear"></div>

                </div> 						<div class="contentFooter">&nbsp;</div>

            </div>
            <?php
            include("application/views/rightsideinfor.php");

            ?>
            <div class="clear"></div>
        </div>
        <?php

        include("application/views/header.php");
        ?>

        <div id="ce"></div>
    </div>
</body>
</html>



