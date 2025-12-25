<div id="contentOuterContainer" class="size1">
    <div class="contentTitle"></div>
                <div class="contentContainer">
                    <div id="content" class="support">
                        <h1 class="titleInHeader"><?php echo $lang['Support']['01']; ?></h1>
                        <?php if(isset($_GET['success']) && $_GET['success'] == 1){ ?>
                            We will try to help you as soon as possible. Please be patient - you will usually receive an answer within 24 hours.
                        <?php }else{ ?>
                            <?php echo $lang['Support']['02']; ?><h3><?php echo $lang['Support']['03']; ?></h3>
                        <form method="post" name="support" id="support">
                            <div id="group_support_gameworld">
                                <table class="form_table form_tablel_support" width="100%">
                                    <tbody><tr>
                                        <td class="form_table_label form_table_label_support_gameworld">
                                            <label class="form_label" for="support[gameworld]"><?php echo $lang['Support']['04']; ?></label></td>
                                        <td class="form_table_element form_table_element_support_gameworld">
                                            <select id="support_gameworld" name="support[gameworld]">
                                                <option value="please_select" selected="yes">Please select</option>
                                                <option value="i_do_not_know">I don't know</option>
                                                <option value="<?php echo SPEED; ?>x - <?php echo HOMEPAGE; ?>"><?php echo SPEED; ?>X - <?php echo HOMEPAGE; ?></option>
                                            </select>
                                            <div class="error"><?php echo $form->getError("gameworld"); ?></div>
                                        </td>
                                    </tr>
                                </tbody></table>
                            </div>
                            <div id="group_support_username">
                                <table class="form_table form_tablel_support" width="100%">
                                    <tbody><tr>
                                        <td class="form_table_label form_table_label_support_username">
                                            <label class="form_label" for="support[username]"><?php echo $lang['Support']['05']; ?></label>
                                        </td>
                                        <td class="form_table_element form_table_element_support_username">
                                            <input type="text" id="support_username" name="support[username]" class="text" label="Username" helper="" value="">
                                            <div class="error"><?php echo $form->getError("username"); ?></div>
                                        </td>
                                    </tr>
                                </tbody></table>
                            </div>
                            <div id="group_support_email">
                                <table class="form_table form_tablel_support" width="100%">
                                    <tbody><tr>
                                        <td class="form_table_label form_table_label_support_email">
                                            <label class="form_label" for="support[email]"><?php echo $lang['Support']['06']; ?></label>
                                        </td>
                                        <td class="form_table_element form_table_element_support_email">
                                            <input type="text" id="support_email" name="support[email]" class="text" label="Email" helper="" value="">

                                            <div class="error"><?php echo $form->getError("email"); ?></div>
                                        </td>
                                    </tr>
                                </tbody></table>
                            </div>
                            <div id="group_support_supportType">
                                <table class="form_table form_tablel_support" width="100%">
                                    <tbody><tr>
                                        <td class="form_table_label form_table_label_support_supportType">
                                            <label class="form_label" for="support[supportType]"><?php echo $lang['Support']['07']; ?></label>
                                        </td>
                                        <td class="form_table_element form_table_element_support_supportType">
                                            <select id="support_supportType" name="support[supportType]">
                                                <option value="please_select" selected="yes">Please select</option>
                                                <option value="general_querstions">General question</option>
                                                <option value="i_can_not_login">Can't access the game</option>
                                                <option value="i_can_not_register">Unauthorized charge</option>
                                            </select>
                                            <div class="error"><?php echo $form->getError("supportType"); ?></div>
                                        </td>
                                    </tr>
                                </tbody></table>
                            </div>
                            <div id="group_support_message">
                                <table class="form_table form_tablel_support" width="100%">
                                    <tbody><tr>
                                        <td class="form_table_label form_table_label_support_message">
                                            <label class="form_label" for="support[message]"><?php echo $lang['Support']['08']; ?></label>
                                        </td>
                                        <td class="form_table_element form_table_element_support_message"><textarea name="support[message]" cols="43" rows="7" label="Message" helper=""></textarea>

                                            <div class="error"><?php echo $form->getError("message"); ?></div>
                                        </td>
                                    </tr>
                                </tbody></table>
                            </div>

                            <div id="group_support_submit">
                                <table class="form_table form_tablel_support" width="100%">
                                    <tbody><tr>
                                        <td class="form_table_label form_table_label_support_submit">
                                            <label class="form_label" for="support[submit]"></label></td>
                                        <td class="form_table_element form_table_element_support_submit">
                                            <button type="submit" value="send request" name="support[submit]" id="support[submit]" class="green " submit="1">
                                                <div class="button-container addHoverClick">
                                                    <div class="button-background">
                                                        <div class="buttonStart">
                                                            <div class="buttonEnd">
                                                                <div class="buttonMiddle"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="button-content"><?php echo $lang['Support']['10']; ?></div>
                                                </div>
                                            </button>
                                            <script type="text/javascript">
                                                window.addEvent('domready', function () {
                                                    if ($('support[submit]')) {
                                                        $('support[submit]').addEvent('click', function () {
                                                            window.fireEvent('buttonClicked', [this, {
                                                                "type": "submit",
                                                                "value": "<?php echo $lang['Support']['10']; ?>",
                                                                "name": "support[submit]",
                                                                "id": "support[submit]",
                                                                "class": "green ",
                                                                "title": "",
                                                                "confirm": "",
                                                                "onclick": "",
                                                                "submit": true
                                                            }]);
                                                        });
                                                    }
                                                });
                                            </script>
                                        </td>
                                    </tr>
                                </tbody></table>
                            </div>
                        </form>
                    <?php } ?>
                    <div class="clear"></div>
                    </div>
                    <div class="clear">&nbsp;</div>
                </div>
                <div class="contentFooter"></div>
            </div>
        </div>