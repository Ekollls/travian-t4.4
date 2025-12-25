<?php
include("application/views/Plus/pmenu.php");
$extragoud="0";
$_SESSION['email']=$session->email;
if(isset($_POST) && !empty($_POST)){
    $_POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
        $Q = $database->query("SELECT * FROM codes WHERE codeNum = '".$_POST['code']."'");

        if(count($Q) > 0){
            if($Q[0]['isUsed']){
                $isError++;
                $Error = 'Used code';
            }else{
                $database->query("UPDATE codes SET isUsed = 1 WHERE id = ".$Q[0]['id']."");
                $database->modifyGold($session->uid,$Q[0]['goldAmount'],1);
                $isError++;
                $Error = 'The code has been shipped successfully and add '. $Q[0][' goldAmount '].' gold to you.';
            }
        }else{
            $isError++;
            $Error = 'Wrong code';
        }

}
?>
<h4 class="round">Recharge gold code</h4>
<p>If you have one of the gold codes, enter it to get detection of the From gold code.</p>
<?php if($isError){ ?>
    <b style="color:red;"><?php echo $Error; ?></b> <br>
<?php } ?>

<form action="" method="post">
<div class="boxes boxesColor gray">
        <div class="boxes-tl"></div>
        <div class="boxes-tr"></div>
        <div class="boxes-tc"></div>
        <div class="boxes-ml"></div>
        <div class="boxes-mr"></div>
        <div class="boxes-mc"></div>
        <div class="boxes-bl"></div>
        <div class="boxes-br"></div>
        <div class="boxes-bc"></div>
        <div class="boxes-contents cf">
            <table class="transparent">
                <tbody>
                <tr>
                    <td>
                    
                        <span class="">club gold</span>
                        <input name="code" type="text" autocomplete="off">
                        <span class="clear"></span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <br>
    <button type="submit" value="search" name="submit" class="gold">
        <div class="button-container addHoverClick">
            <div class="button-background">
                <div class="buttonStart">
                    <div class="buttonEnd">
                        <div class="buttonMiddle"></div>
                    </div>
                </div>
            </div>
            <div class="button-content">Charge</div>
        </div>
    </button>    

</form>