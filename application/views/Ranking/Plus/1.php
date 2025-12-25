<?php
include("application/views/Plus/pmenu.php");$extragoud="0";
$_SESSION['email']=$session->email;
?>
<?php if ($language=='ru'){ ?>
<style>
    .tdc{text-align:center;}
</style>
<table width="100%" cellpadding="1" cellspacing="1" >
    <tr><thead>
        <th colspan="5"><center><b><font color="orange"><u>Покупка золота</u></b></font></center></th> <br>
    </tr>
    </thead><tr>
        <td  class="tdc" width="20%">#</td>
        <td  class="tdc" width="20%">Цена</td>
        <td  class="tdc" width="20%">Количестinо</td>
        <td  class="tdc" width="20%">Покупка(RU)</td>

    </tr><tr>
        <td class="tdc"> Тариф A</td>
        <td class="tdc"> 150 p</td>
        <td class="tdc"> 150 <img src="img/x.gif" class="gold" alt="gold"></td>
        <td class="tdc"> <a onclick="Travian.Game.Payment('ARU')">Купить</a></td>
    </tr>
    <tr>
        <td class="tdc"> Тариф B</td>
        <td class="tdc"> 300 p</td>
        <td class="tdc"> 350 <img src="img/x.gif" class="gold" alt="gold"></td>
        <td class="tdc"> <a onclick="Travian.Game.Payment('BRU')">Купить</a></td>

    </tr><tr>
        <td class="tdc"> Тариф C</td>
        <td class="tdc"> 600 p</td>
        <td class="tdc"> 750 <img src="img/x.gif" class="gold" alt="gold"></td>
        <td class="tdc"><a onclick="Travian.Game.Payment('CRU')">Купить</a></td>

    </tr>
    <tr>
        <td class="tdc"> Тариф D</td>
        <td class="tdc"> 900 p</td>
        <td class="tdc"> 1200 <img src="img/x.gif" class="gold" alt="gold"></td>
        <td class="tdc"><a onclick="Travian.Game.Payment('DRU')">Купить</a></td>

    </tr>
    <tr>
        <td class="tdc"> Тариф E</td>
        <td class="tdc"> 1500 p</td>
        <td class="tdc"> 2500 <img src="img/x.gif" class="gold" alt="gold"></td>
        <td class="tdc"><a onclick="Travian.Game.Payment('ERU')">Купить</a></td>
    </tr>
    <tr>
        <td class="tdc"> Тариф F</td>
        <td class="tdc"> 2250 p</td>
        <td class="tdc"> 4000 <img src="img/x.gif" class="gold" alt="gold"></td>
        <td class="tdc"><a onclick="Travian.Game.Payment('FRU')">Купить</a></td>

    </tr>
	 <tr>
       <td class="tdc" ><font color="red"><b>MEGA PACK</b></font></td>
        <td class="tdc" > 5000 p</td>
        <td class="tdc"> 16000 <img src="img/x.gif" class="gold" alt="gold"></td>
        <td class="tdc"><a onclick="Travian.Game.Payment('SRU')">Купить</a></td>

    </tr>


</table><br/>


<br/>
<br /><center> in случае inозникноinения inопросоin обращайтесь к <a onclick="Travian.Game.PopupMessage('?t=1&id=6')">Администратору</a></center>
<br><center>Золото зачисляется на аккаунт сразу после оплаты. </center>
<br><br /><br /><center>Остаток золота с прошлого раунда inы можете переinести through <a target="_blank" href="http://x<?php echo SPEED ?>.xtravian.ru/plus.php?id=6">Банк</a></center><br>
<?php } if ($language == 'en'){?>
	<style>
    .tdc{text-align:center;}
</style>
<table width="100%" cellpadding="1" cellspacing="1" >
    <tr><thead>
        <th colspan="5"><center><b><font color="orange"><u>GOLD SHOP</u></b></font></center></th> <br>
    </tr>
    </thead><tr>
        <td  class="tdc" width="20%">#</td>
        <td  class="tdc" width="20%">Price</td>
        <td  class="tdc" width="20%">Amount</td>
        <td  class="tdc" width="20%">Buy(USD)</td>

    </tr><tr>
        <td class="tdc"> Tariff A</td>
        <td class="tdc"> 3 USD</td>
        <td class="tdc"> 150 <img src="img/x.gif" class="gold" alt="gold"></td>
        <td class="tdc"> <a onclick="Travian.Game.Payment('AUS')">Buy</a></td>
    </tr>
    <tr>
        <td class="tdc"> Tariff B</td>
        <td class="tdc"> 6 USD</td>
        <td class="tdc"> 350 <img src="img/x.gif" class="gold" alt="gold"></td>
        <td class="tdc"> <a onclick="Travian.Game.Payment('BUS')">Buy</a></td>

    </tr><tr>
        <td class="tdc"> Tariff C</td>
        <td class="tdc"> 10 USD</td>
        <td class="tdc"> 750 <img src="img/x.gif" class="gold" alt="gold"></td>
        <td class="tdc"><a onclick="Travian.Game.Payment('CUS')">Buy</a></td>

    </tr>
    <tr>
        <td class="tdc"> Tariff D</td>
        <td class="tdc"> 14 USD</td>
        <td class="tdc"> 1200 <img src="img/x.gif" class="gold" alt="gold"></td>
        <td class="tdc"><a onclick="Travian.Game.Payment('DUS')">Buy</a></td>

    </tr>
    <tr>
        <td class="tdc"> Tariff E</td>
        <td class="tdc"> 23 USD</td>
        <td class="tdc"> 2500 <img src="img/x.gif" class="gold" alt="gold"></td>
        <td class="tdc"><a onclick="Travian.Game.Payment('EUS')">Buy</a></td>
    </tr>
    <tr>
        <td class="tdc"> Tariff F</td>
        <td class="tdc"> 35 USD</td>
        <td class="tdc"> 4000 <img src="img/x.gif" class="gold" alt="gold"></td>
        <td class="tdc"><a onclick="Travian.Game.Payment('FUS')">Buy</a></td>

    </tr>
	 <tr>
       <td class="tdc" ><font color="red"><b>MEGA PACK</b></font></td>
        <td class="tdc" > 75 USD</td>
        <td class="tdc"> 16000 <img src="img/x.gif" class="gold" alt="gold"></td>
        <td class="tdc"><a onclick="Travian.Game.Payment('SUS')">Buy</a></td>

    </tr>


</table><br/>


<br/>
<br /><center> in случае inозникноinения inопросоin обращайтесь к <a onclick="Travian.Game.PopupMessage('?t=1&id=6')">Администратору</a></center>
<br><center>Золото зачисляется на аккаунт сразу после оплаты. </center>
<br><br /><br /><center>Остаток золота с прошлого раунда inы можете переinести through <a target="_blank" href="http://x<?php echo SPEED ?>.xtravian.ru/plus.php?id=6">Банк</a></center><br>
<?php }?>