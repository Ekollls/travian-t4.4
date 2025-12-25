<span class="error" style="color:red;"><?php echo $form->getError("user"); ?></span>
<div id="messageNavigation">
    <div id="backToInbox">
        <a href="nachrichten.php">Return to inbox:</a>
    </div>
    <div class="clear"></div>
</div>
<div id="write_head" class="msg_head"></div>
<div id="write_content" class="msg_content">
    <form method="post" action="nachrichten.php?t=1<?php echo $_GET['id'] ? '&id='.$_GET['id'].'' : ''; ?>" accept-charset="UTF-8" name="msg">
        <div class="paper">
            <div class="layout">
                <div class="paperTop">
				 <div class="paperContent">
               
           
                <div id="recipient">
                    <div class="header label"><?=MSG12?></div>
                    <div class="header text">
                        <input tabindex="1" class="text" type="text" name="an" id="receiver" value="<?php if(isset($id)){ echo $database->getUserField($id,'username',0); } if($_POST['an']){ echo $_POST['an']; } ?>" maxlength="50" onkeyup="copyElement('receiver')" >


                        <button title="Ally" type="button" value="ally" id="ally" class="icon" tabindex="6" onclick="this.form.receiver.value='[ally]';">
						                    <div class="clear"></div>
                            <img src="img/x.gif" class="ally" alt="ally"></button>
							
                    </div>


                </div>
                <div id="subject">
                    <div class="header label"><?=MSG0?></div>
                    <div class="header text"><input tabindex="2" class="text" maxlength="50" name="be" id="subject" type="text" value="<?php 
                    if(isset($message->reply['topic']))
                        {
                            if (preg_match("/RE([0-9]+)/i",$message->reply['topic'],$c))
                            {
                                $c = $c[1]+1;
                                echo $message->reply['topic'] = preg_replace("/re[0-9]+/i","RE".($c),$message->reply['topic']);
                            }else{
                                echo "RE1:".$message->reply['topic']; }}  if($_POST['be']){ echo $_POST['be']; } ?>" name="be" onkeyup="copyElement('subject')"></div>
                    <div class="clear"></div>
                </div>
                <div id="bbEditor">

                    <div id="message_container" class="bbEditor"><div class="boxes boxesColor gray">
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
                                    <div id="message_toolbar" class="bbToolbar">
                                        <button type="button" class="icon bbButton bbBold bbType{d} bbTag{b}" title="bold">
                                            <img src="img/x.gif" class="bbBold" alt="bbBold">
                                        </button>
                                        <button type="button" class="icon bbButton bbItalic bbType{d} bbTag{i}" title="italic">
                                            <img src="img/x.gif" class="bbItalic" alt="bbItalic">
                                        </button>
                                        <button type="button" class="icon bbButton bbUnderscore bbType{d} bbTag{u}" title="underline">
                                            <img src="img/x.gif" class="bbUnderscore" alt="bbUnderscore">
                                        </button>
                                        <button type="button" class="icon bbButton bbAlliance bbType{d} bbTag{alliance}" title="alliance">
                                            <img src="img/x.gif" class="bbAlliance" alt="bbAlliance">
                                        </button>
                                        <button type="button" class="icon bbButton bbPlayer bbType{d} bbTag{player}" title="player">
                                            <img src="img/x.gif" class="bbPlayer" alt="bbPlayer">
                                        </button>
                                        <button type="button" class="icon bbButton bbCoordinate bbType{d} bbTag{x|y}" title="Coordinates">
                                            <img src="img/x.gif" class="bbCoordinate" alt="bbCoordinate">
                                        </button>
                                        <button type="button" class="icon bbButton bbReport bbType{d} bbTag{report}" title="report">
                                            <img src="img/x.gif" class="bbReport" alt="bbReport">
                                        </button>
                                        <button type="button" id="message_resourceButton" class="icon bbWin{resources} bbButton bbResource" title="Resources">
                                            <img src="img/x.gif" class="bbResource" alt="bbResource">
                                        </button>
                                        <button type="button" id="message_smilieButton" class="icon bbWin{smilies} bbButton bbSmilies" title="smilies">
                                            <img src="img/x.gif" class="bbSmilies" alt="bbSmilies">
                                        </button>
                                        <button type="button" id="message_troopButton" class="icon bbWin{troops} bbButton bbTroops" title="Forces">
                                            <img src="img/x.gif" class="bbTroops" alt="bbTroops">
                                        </button>
                                        <button type="button" id="message_previewButton" class="icon bbButton bbPreview" title="Preview">
                                            <img src="img/x.gif" class="bbPreview" alt="bbPreview">
                                        </button>
                                        <div class="clear"></div>
                                        <div id="message_toolbarWindows" class="bbToolbarWindow">
                                            <div id="message_resources">
                                                <a href="#" class="bbType{o} bbTag{l}">
                                                    <img src="img/x.gif" class="r1" alt="wood">
                                                </a>
                                                <a href="#" class="bbType{o} bbTag{cl}">
                                                    <img src="img/x.gif" class="r2" alt="clay">
                                                </a>
                                                <a href="#" class="bbType{o} bbTag{c}">
                                                    <img src="img/x.gif" class="r4" alt="iron">
                                                </a>
                                                <a href="#" class="bbType{o} bbTag{ir}">
                                                    <img src="img/x.gif" class="r3" alt="crop">
                                                </a>
                                            </div>
                                            <div id="message_smilies">
                                                <a href="#" class="bbType{s} bbTag{*aha*}">
                                                    <img class="smiley aha" src="img/x.gif" alt="*aha*">
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*angry*}">
                                                    <img class="smiley angry" src="img/x.gif" alt="*angry*">
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*cool*}">
                                                    <img class="smiley cool" src="img/x.gif" alt="*cool*">
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*cry*}">
                                                    <img class="smiley cry" src="img/x.gif" alt="*cry*">
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*cute*}">
                                                    <img class="smiley cute" src="img/x.gif" alt="*cute*">
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*depressed*}">
                                                    <img class="smiley depressed" src="img/x.gif" alt="*depressed*">
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*eek*}">
                                                    <img class="smiley eek" src="img/x.gif" alt="*eek*">
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*ehem*}">
                                                    <img class="smiley ehem" src="img/x.gif" alt="*ehem*">
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*emotional*}">
                                                    <img class="smiley emotional" src="img/x.gif" alt="*emotional*">
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{:D}">
                                                    <img class="smiley grin" src="img/x.gif" alt=":D">
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{:)}">
                                                    <img class="smiley happy" src="img/x.gif" alt=":)">
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*hit*}">
                                                    <img class="smiley hit" src="img/x.gif" alt="*hit*">
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*hmm*}">
                                                    <img class="smiley hmm" src="img/x.gif" alt="*hmm*">
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*hmpf*}">
                                                    <img class="smiley hmpf" src="img/x.gif" alt="*hmpf*">
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*hrhr*}">
                                                    <img class="smiley hrhr" src="img/x.gif" alt="*hrhr*">
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*huh*}">
                                                    <img class="smiley huh" src="img/x.gif" alt="*huh*">
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*lazy*}">
                                                    <img class="smiley lazy" src="img/x.gif" alt="*lazy*">
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*love*}">
                                                    <img class="smiley love" src="img/x.gif" alt="*love*">
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*nocomment*}">
                                                    <img class="smiley nocomment" src="img/x.gif" alt="*nocomment*">
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*noemotion*}">
                                                    <img class="smiley noemotion" src="img/x.gif" alt="*noemotion*">
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*notamused*}">
                                                    <img class="smiley notamused" src="img/x.gif" alt="*notamused*">
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*pout*}">
                                                    <img class="smiley pout" src="img/x.gif" alt="*pout*">
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*redface*}">
                                                    <img class="smiley redface" src="img/x.gif" alt="*redface*">
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*rolleyes*}">
                                                    <img class="smiley rolleyes" src="img/x.gif" alt="*rolleyes*">
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{:(}">
                                                    <img class="smiley sad" src="img/x.gif" alt=":(">
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*shy*}">
                                                    <img class="smiley shy" src="img/x.gif" alt="*shy*">
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*smile*}">
                                                    <img class="smiley smile" src="img/x.gif" alt="*smile*">
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*tongue*}">
                                                    <img class="smiley tongue" src="img/x.gif" alt="*tongue*">
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*veryangry*}">
                                                    <img class="smiley veryangry" src="img/x.gif" alt="*veryangry*">
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*veryhappy*}">
                                                    <img class="smiley veryhappy" src="img/x.gif" alt="*veryhappy*">
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{;)}">
                                                    <img class="smiley wink" src="img/x.gif" alt=";)">
                                                </a>
                                            </div>
                                            <div id="message_troops">
                                                                                                    <a href="#" class="bbType{o} bbTag{tid1}">
                                                        <img class="unit u1" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid2}">
                                                        <img class="unit u2" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid3}">
                                                        <img class="unit u3" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid4}">
                                                        <img class="unit u4" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid5}">
                                                        <img class="unit u5" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid6}">
                                                        <img class="unit u6" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid7}">
                                                        <img class="unit u7" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid8}">
                                                        <img class="unit u8" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid9}">
                                                        <img class="unit u9" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid10}">
                                                        <img class="unit u10" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid11}">
                                                        <img class="unit u11" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid12}">
                                                        <img class="unit u12" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid13}">
                                                        <img class="unit u13" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid14}">
                                                        <img class="unit u14" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid15}">
                                                        <img class="unit u15" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid16}">
                                                        <img class="unit u16" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid17}">
                                                        <img class="unit u17" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid18}">
                                                        <img class="unit u18" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid19}">
                                                        <img class="unit u19" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid20}">
                                                        <img class="unit u20" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid21}">
                                                        <img class="unit u21" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid22}">
                                                        <img class="unit u22" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid23}">
                                                        <img class="unit u23" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid24}">
                                                        <img class="unit u24" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid25}">
                                                        <img class="unit u25" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid26}">
                                                        <img class="unit u26" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid27}">
                                                        <img class="unit u27" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid28}">
                                                        <img class="unit u28" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid29}">
                                                        <img class="unit u29" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid30}">
                                                        <img class="unit u30" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid31}">
                                                        <img class="unit u31" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid32}">
                                                        <img class="unit u32" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid33}">
                                                        <img class="unit u33" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid34}">
                                                        <img class="unit u34" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid35}">
                                                        <img class="unit u35" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid36}">
                                                        <img class="unit u36" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid37}">
                                                        <img class="unit u37" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid38}">
                                                        <img class="unit u38" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid39}">
                                                        <img class="unit u39" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid40}">
                                                        <img class="unit u40" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid41}">
                                                        <img class="unit u41" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid42}">
                                                        <img class="unit u42" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid43}">
                                                        <img class="unit u43" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid44}">
                                                        <img class="unit u44" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid45}">
                                                        <img class="unit u45" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid46}">
                                                        <img class="unit u46" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid47}">
                                                        <img class="unit u47" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid48}">
                                                        <img class="unit u48" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid49}">
                                                        <img class="unit u49" src="img/x.gif" alt="">
                                                    </a>
                                                                                                    <a href="#" class="bbType{o} bbTag{tid50}">
                                                        <img class="unit u50" src="img/x.gif" alt="">
                                                    </a>
                                                                                                <a href="#" class="bbType{o} bbTag{hero}">
                                                    <img class="unit uhero" src="img/x.gif" alt="Hero">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <input type="hidden" name="key" value="<?=$_SESSION['mescheck']?>" />
                        <div class="line bbLine"></div>
                        <textarea id="message" name="message" class="messageEditor" tabindex="3" cols="1" rows="1"><?php if($_POST['message']){ echo $_POST['message']; } if(isset($message->reply['message'])) { echo " \n_________________________
Reply:
\n".$message->reply['message']; } ?></textarea>
                        <div id="message_preview" class="messageEditor preview" style="display: none; "></div>
                    </div>

                    <script type="text/javascript">

                        window.addEvent('domready', function()

                        {
                            new Travian.Game.BBEditor("message");

                        });
                    </script>
                </div>
                <div id="send">
                    <button type="submit" value="send"  name="s1" id="btn_ok" class="green ">
                        <div class="button-container addHoverClick ">
                            <div class="button-background">
                                <div class="buttonStart">
                                    <div class="buttonEnd">
                                        <div class="buttonMiddle"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-content"><?=MSG13?></div></div></button>
                    <input type="hidden" name="ft" value="m2" />
                </div>

            </div>

        <div class="clear"></div>
</div>
			</div>
			<div class="paperBottom"></div>
		</div>
		</div>
		
</form>
<script type="text/javascript">
    Travian.Translation.add(
            {
                'nachrichten.adressbuch': 'Address titles',
                'allgemein.save': 'save'
            });
    window.addEvent('domready', function () {
        Travian.Game.Messages.Write.initialize();
                    });
</script>
