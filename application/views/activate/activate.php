
<?php
if(isset($_GET['id']) && isset($_GET['q'])) {
	$id=$database->filterstringvalue($_GET['id']);
$act=$database->gettwoField($id,"act2,username,email");
    if($act['act2']==$_GET['q']){
    $show='1';
    $naam=$act['username'];
    $email=$act['email'];

    }
}
if(isset($show)){
$_SESSION['username']=$naam;
header("first.php");

 }else{ ?>
    <div id="activationFormContainer">
        <form name="activation" id="activation" method="post">
            <input type="hidden" name="ft" value="a5" />
				<span id="activationNeeded">
					<?=activate0?>				</span>
            <table cellpadding="0" cellspacing="0">
                <tbody><tr>
                    <th></th>
                    <td class="spacer">&nbsp;</td>

                </tr>

                <tr>
                    <th>
                        <?=activate1?>					</th>
                    <td class="activationCode">
                        <input class="text" type="text" name="id" maxlength="10" value="<?php if(isset($_GET['code'])){echo $_GET['code']; }?>"/>

                        
<?php if($_GET['e']==3){
        echo "<div class=\"error\"><small>".ACTIV10."</small></div>";
    }?>
                        
                    </td>
                </tr>
                
                </tbody></table>
                <div class="clear"></div>
                <br>
                <button type="submit" value="<?=activate2?>" id="ActivateButton" class="green button" style="">
                            <div class="button-container addHoverClick">
                                <div class="button-background">
                                    <div class="buttonStart">
                                        <div class="buttonEnd">
                                            <div class="buttonMiddle"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="button-content"><?=activate2?></div>
                            </div>
                        </button>

        </form>


        </div>
        </div>
            <div class="greenbox-bottom"></div>
            <div class="clear"></div>




<?php }
?>