

			<div class="clear"></div>
                <div id="footer">
                    <div id="pageLinks">
                        <a href="#" target="_blank"><?php echo $lang['Footer']['Homepage']; ?></a>
                        <a href="#" target="_blank"><?php echo $lang['Footer']['Forum']; ?></a>
                        <a href="#" target="_blank"><?php echo $lang['Footer']['FAQ']; ?></a>
                        <a href="#" target="_blank"><?php echo $lang['Footer']['Terms']; ?></a>
                        <a href="#" target="_blank"><?php echo $lang['Footer']['Imprint']; ?></a>
                        <div class="clear"></div>
                    </div>
                    <br>
                    <p class="copyright" style="direction:ltr;">© 2019 - 2020 Travian Games GmbH</p>
					                                         
                    <br>
                </div>
        <div id="servertime" class="stime">
            <?php echo SERVER_TIME; ?>&nbsp;
            <span class="timer" counting="up" value="<?php echo time(); ?>"><?php echo date('H:i:s'); ?></span>
        </div>

</div>
