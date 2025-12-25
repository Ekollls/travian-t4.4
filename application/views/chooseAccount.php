<center><font color="red"><h3>Please, choose subscription type!</h3></font></center>


Buy subscription <b>750</b> <img src="img/x.gif" class="gold"><?php

if($session->gold >= 750) {
    echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button type=\"button\"  class=\"green ".$disabl."\" onclick=\"return Travian.Game.buyplus(15,".HOWRES."); return false;\"><div class=\"button-container addHoverClick \">     <div class=\"button-background\">         <div class=\"buttonStart\">             <div class=\"buttonEnd\">                 <div class=\"buttonMiddle\"></div>             </div>         </div>     </div>     <div class=\"button-content\">Buy</div></div></button>";
} else {
    //echo "<button type=\"button\" class=\"gold \"  class=\" disabled\" onclick=\"(new Event(event)).stop(); return false;\" onfocus=\"$$('button', 'input[type!=hidden]', 'select')[0].focus(); (new Event(event)).stop(); return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">".PLUS14."</div></div></button>";
    echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button class=\"gold \" type=\"button\"  class=\" disabled\" onclick=\"(new Event(event)).stop(); return false;\" onfocus=\"$$('button', 'input[type!=hidden]', 'select')[0].focus(); (new Event(event)).stop(); return false;\"><div class=\"button-container addHoverClick \">     <div class=\"button-background\">         <div class=\"buttonStart\">             <div class=\"buttonEnd\">                 <div class=\"buttonMiddle\"></div>             </div>         </div>     </div>     <div class=\"button-content\">".pluss27."</div></div></button>";

}
    ?><p>
Or Play Free:
	 <?php
if($session->gold >= 0) {
    echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button type=\"button\"  class=\"green ".$disabl."\" onclick=\"return Travian.Game.buyplus(16,".HOWRES."); return false;\"><div class=\"button-container addHoverClick \">     <div class=\"button-background\">         <div class=\"buttonStart\">             <div class=\"buttonEnd\">                 <div class=\"buttonMiddle\"></div>             </div>         </div>     </div>     <div class=\"button-content\">Play Free</div></div></button>";
} else {
    //echo "<button type=\"button\" class=\"gold \"  class=\" disabled\" onclick=\"(new Event(event)).stop(); return false;\" onfocus=\"$$('button', 'input[type!=hidden]', 'select')[0].focus(); (new Event(event)).stop(); return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">".PLUS14."</div></div></button>";
    echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button class=\"gold \" type=\"button\"  class=\" disabled\" onclick=\"(new Event(event)).stop(); return false;\" onfocus=\"$$('button', 'input[type!=hidden]', 'select')[0].focus(); (new Event(event)).stop(); return false;\"><div class=\"button-container addHoverClick \">     <div class=\"button-background\">         <div class=\"buttonStart\">             <div class=\"buttonEnd\">                 <div class=\"buttonMiddle\"></div>             </div>         </div>     </div>     <div class=\"button-content\">".pluss27."</div></div></button>";

}
    ?>

	<b><p>Advantages of paid subscription:</b>
	
	<p>1) You can win <b><font color="red">150$</font></b> PRIZE
	<p>2) Travian PLUS for 7 days
	<p>3) All reourses production for 7 days