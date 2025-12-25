<?php
class Alliance
{

    public $gotInvite = false;
    public $inviteArray = array();
    public $allianceArray = array();
    public $userPermArray = array();

    public function procAlliance($get)
    {
        global $session, $database;

        if ($session->alliance != 0) {
            $this->allianceArray = $database->getAlliance($session->alliance);
            // Permissions Array
            $this->userPermArray = $database->getAlliPermissions($session->uid, $session->alliance);
        } else {
            $this->inviteArray = $database->getInvitation($session->uid);
            $this->gotInvite = count($this->inviteArray) == 0 ? false : true;
        }
        if (isset($get['a'])) {
            switch ($get['a']) {
                case 2:
                    $this->rejectInvite($get);
                    break;
                case 3:
                    $this->acceptInvite($get);
                    break;
                default:
                    break;
            }
        }
        if (isset($get['o'])) {
            switch ($get['o']) {
                case 4:
                    $this->delInvite($get);
                    break;
                default:
                    break;
            }
        }
    }

    public function procAlliForm($post)
    {
        if (isset($post['ft'])) {
            switch ($post['ft']) {
                case "ali1":
                    $this->createAlliance($post);
                    break;
            }

        }
        if (isset($_POST['dipl']) and isset($_POST['a_name'])) {
            $this->changediplomacy($post);
        }

        if (isset($post['s'])) {
            if (isset($post['o'])) {
                switch ($post['o']) {
                    case 1:
                        if (isset($_POST['a'])) {

                            $this->changeUserPermissions($post);
                        }
                        break;
                    case 2:
                        if (isset($_POST['a_user'])) {
                            $this->kickAlliUser($post);
                        }
                        break;
                    case 4:
                        if (isset($_POST['a']) && $_POST['a'] == 4) {
                            $this->sendInvite($post);
                        }
                        break;
                    case 3:
                        $this->updateAlliProfile($post);
                        break;
                    case 11:
                        $this->quitally($post);
                        break;
                    case 100:
                        $this->changeAliName($post);
                        break;
                }
            }
        }
    }

    /*****************************************
     * Function to process of sending invitations
     *****************************************/
    public function sendInvite($post)
    {
        global $form, $database, $session;
            if (isset($post['a_name'])) {
                $post['a_name'] = $database->FilterStringValue($post['a_name']);
                $UserData = $database->getUserArray($post['a_name'], 0);
                if ($this->userPermArray['opt4'] == 0) {
                    $form->addError("perm", NO_PERMISSION);
                } elseif (!isset($post['a_name']) || $post['a_name'] == "") {
                    $form->addError("name1", NAME_EMPTY);
                } elseif (!$database->checkExist($post['a_name'], 0)) {
                    $form->addError("name2", NAME_NO_EXIST . $database->RemoveXSS($post['a_name']));
                } elseif ($post['a_name'] == ($database->RemoveXSS($session->username))) {
                    $form->addError("name3", SAME_NAME);
                } elseif ($database->getInvitation2($UserData['id'], $session->alliance)) {
                    $form->addError("name4", $database->RemoveXSS($post['a_name']) . ALREADY_INVITED);
                } elseif ($UserData['alliance'] == $session->alliance) {
                    $form->addError("name5", $database->RemoveXSS($post['a_name']) . ALREADY_IN_ALLY);
                } else {
                    // Obtenemos la informacion necesaria
                    $aid = $session->alliance;
                    $aData = $database->queryFetch('SELECT name FROM alidata WHERE id = '.$aid.'');
                    
                    // iRedux
                    $database->sendMessage($UserData['id'], 0, 'you received an invitation From alliance <a href="allianz.php?aid='.$aid.'">'.$aData['name'].'</a> Enter the embassy to accept or decline an invitation.', 0, 0, 0, 0,0);

                    // Insertamos invitacion
                    $database->sendInvitation($UserData['id'], $aid);
                    // Log the notice
                    $database->insertAlliNotice($session->alliance, '<a href="spieler.php?uid=' . $session->uid . '">' . $database->RemoveXSS($session->username) . '</a>' . ALLIANCE33 . '<a href="spieler.php?uid=' . $UserData['id'] . '">' . $database->RemoveXSS($UserData['username']) . '</a>.');
                }
            }

    }

    /*****************************************
     * Function to reject an invitation
     *****************************************/
    private function rejectInvite($get)
    {
        global $database, $session;
            foreach ($this->inviteArray as $invite) {
                if ($invite['id'] == $get['d']) {
                    $database->removeInvitation($get['d']);
                    $database->insertAlliNotice($invite['alliance'], '<a href="spieler.php?uid=' . $session->uid . '">' . $database->RemoveXSS($session->username) . '</a> ' . ALLIANCE34 . '.');
                }
            }
            header("Location: build.php?id=" . $get['id']);

    }

    /*****************************************
     * Function to del an invitation
     *****************************************/
    private function delInvite($get)
    {
        global $database, $session;
            $inviteArray = $database->getAliInvitations($session->alliance);
            foreach ($inviteArray as $invite) {
                if ($invite['id'] == $get['d']) {
                    $invitename = $database->getUserArray($invite['uid'], 1);
                    $database->removeInvitation($get['d']);
                    $database->insertAlliNotice($session->alliance, '<a href="spieler.php?uid=' . $session->uid . '">' . $database->RemoveXSS($session->username) . '</a> ' . ALLIANCE35 . ' <a href="spieler.php?uid=' . $invitename['id'] . '">' . $database->RemoveXSS($invitename['username']) . '</a>.');
                }
            }
            header("Location: allianz.php?delinvite");

    }

    /*****************************************
     * Function to accept an invitation
     *****************************************/
    private function acceptInvite($get)
    {
        global $form, $database, $session;
        $accept_error=0;
            foreach ($this->inviteArray as $invite) {
                if ($session->alliance == 0) {
                    if ($invite['id'] == $get['d'] && $invite['uid'] == $session->uid) {
                        $memberlist = $database->getAllMember($invite['alliance']);
                        $alliance_info = $database->getAlliance($invite['alliance']);
                        if (count($memberlist) < $alliance_info['max']) {
                            $database->removeInvitation($database->RemoveXSS($get['d']));
                            $database->updateUserField($database->RemoveXSS($invite['uid']), "alliance", $database->RemoveXSS($invite['alliance']), 1);
                            $database->createAlliPermissions($database->RemoveXSS($invite['uid']), $database->RemoveXSS($invite['alliance']), '', '0', '0', '0', '0', '0', '0', '0', '0');
                            // Log the notice
                            $database->insertAlliNotice($invite['alliance'], '<a href="spieler.php?uid=' . $session->uid . '">' . $database->RemoveXSS($session->username) . '</a> ' . ALLIANCE41 . '.');
                        } else {
                            $accept_error = 1;
                        }
                    }
                }
            }
            if ($accept_error == 1) {
                $form->addError("ally_accept", ALLIANCE37);
            } else {
                header("Location: build.php?id=" . $get['id']);
            }

    }

    /*****************************************
     * Function to create an alliance
     *****************************************/
    private function createAlliance($post)
    {
        global $form, $database, $session, $bid18, $village;

            if (!isset($post['ally1']) || $post['ally1'] == "") {
                $form->addError("ally1", ATAG_EMPTY);
            }
            if (!isset($post['ally2']) || $post['ally2'] == "") {
                $form->addError("ally2", ANAME_EMPTY);
            }
            if ($database->aExist($post['ally1'], "tag",$session->alliance)) {
                $form->addError("ally1", ATAG_EXIST);
            }
            if ($database->aExist($post['ally2'], "name",$session->alliance)) {
                $form->addError("ally2", ANAME_EXIST);
            }
            if ($form->returnErrors() != 0) {
                $_SESSION['errorarray'] = $form->getErrors();
                $_SESSION['valuearray'] = $post;

                header("Location: build.php?id=" . $post['id']);
            } else {
                $max = $bid18[$village->resarray['f' . $post['id']]]['attri'];
                $aid = $database->createAlliance($database->RemoveXSS($database->FilterStringValue($post['ally1'])), $database->RemoveXSS($database->FilterStringValue($post['ally2'])), $session->uid, $max);
                $database->updateUserField($database->RemoveXSS($session->uid), "alliance", $database->RemoveXSS($aid), 1);
                // Asign Permissions
                $database->createAlliPermissions($database->RemoveXSS($session->uid), $database->RemoveXSS($aid), ALLIANCE38, '1', '1', '1', '1', '1', '1', '1', '1');
                // log the notice
                $database->insertAlliNotice($aid, '' . ALLIANCE39 . ' <a href="spieler.php?uid=' . $session->uid . '">' . $database->RemoveXSS($session->username) . '</a>.');
                header("Location: build.php?id=" . $post['id']);
            }

    }

    /*****************************************
     * Function to change the alliance name
     *****************************************/
    private function changeAliName($get)
    {
        global $form, $database, $session;
            if (!isset($get['ally1']) || $get['ally1'] == "") {
                $form->addError("ally1", ATAG_EMPTY);
            }
            if (!isset($get['ally2']) || $get['ally2'] == "") {
                $form->addError("ally2", ANAME_EMPTY);
            }
            if ($database->aExist($get['ally1'], "tag",$session->alliance)) {
                $form->addError("tag", ATAG_EXIST);
            }
            if ($database->aExist($get['ally2'], "name",$session->alliance)) {
                $form->addError("name", ANAME_EXIST);
            }
            if ($this->userPermArray['opt3'] == 0) {
                $form->addError("perm", NO_PERMISSION);
            }
            if ($form->returnErrors() != 0) {
                $_SESSION['errorarray'] = $form->getErrors();
                $_SESSION['valuearray'] = $get;
                header("Location: build.php?id=".$get['id']);
            } else {
                $database->setAlliName($database->RemoveXSS($session->alliance), $database->RemoveXSS($database->FilterStringValue($get['ally2'])), $database->RemoveXSS($database->FilterStringValue($get['ally1'])));
                // log the notice
                $database->insertAlliNotice($session->alliance, '<a href="spieler.php?uid=' . $session->uid . '">' . $database->RemoveXSS($session->username) . '</a> ' . ALLIANCE40 . '.');
            }

    }

    /*****************************************
     * Function to create/change the alliance description
     *****************************************/
    private function updateAlliProfile($post)
    {
        global $database, $session, $form;
            if ($this->userPermArray['opt3'] == 0) {
                $form->addError("perm", NO_PERMISSION);
            }
            if ($form->returnErrors() != 0) {
                $_SESSION['errorarray'] = $form->getErrors();
                $_SESSION['valuearray'] = $post;
                //header("Location: build.php?id=".$post['id']);
            } else {
                $database->submitAlliProfile($session->alliance, $post['be2'], $post['be1']);
                // log the notice
                $database->insertAlliNotice($session->alliance, '<a href="spieler.php?uid=' . $session->uid . '">' . $database->RemoveXSS($session->username) . '</a> ' . ALLIANCE42 . '.');
            }

    }

    /*****************************************
     * Function to change the user permissions
     *****************************************/
    private function changeUserPermissions($post)
    {
        global $database, $session, $form;
            if ($this->userPermArray['opt1'] == 0) {

                $form->addError("perm", NO_PERMISSION);
            }
            if ($form->returnErrors() != 0) {
                $_SESSION['errorarray'] = $form->getErrors();
                $_SESSION['valuearray'] = $post;
                //header("Location: build.php?id=".$post['id']);
            } else {
                for($i=1;$i<=7;$i++){if(!isset($post['e'.$i])){$post['e'.$i]=0;}}

                $database->updateAlliPermissions($database->FilterStringValue($post['a_user']), $session->alliance, $database->FilterStringValue($post['a_titel']), $post['e1'], $post['e2'], $post['e3'], $post['e4'], 0, $post['e6'], $post['e7']);
                // log the notice
                $database->insertAlliNotice($session->alliance, '<a href="spieler.php?uid=' . $session->uid . '">' . $database->RemoveXSS($session->username) . '</a> ' . ALLIANCE43 . '.');
            }

    }

    /*****************************************
     * Function to kick a user from alliance
     *****************************************/
    private function kickAlliUser($post)
    {
        global $database, $session, $form;
            $UserData = $database->getUserArray($post['a_user'], 0);
            if ($this->userPermArray['opt2'] == 0) {
                $form->addError("perm", NO_PERMISSION);
            } else if ($UserData['id'] != $session->uid) {
                $database->updateUserField($post['a_user'], 'alliance', 0, 1);
                $database->deleteAlliPermissions($post['a_user']);
                $database->deleteAlliance($session->alliance);
                // log the notice
                $database->insertAlliNotice($session->alliance, '<a href="spieler.php?uid=' . $UserData['id'] . '">' . $database->RemoveXSS($post['a_user']) . '</a> ' . ALLIANCE44 . '.');
            }

    }

    /*****************************************
     * Function to quit from alliance
     *****************************************/
    private function quitally($post)
    {
        global $database, $session, $form;

            if (!isset($post['pw']) || $post['pw'] == "") {
                $form->addError("pw1", PW_EMPTY);
            } elseif (md5($post['pw'].mb_convert_case($session->username,MB_CASE_LOWER,"UTF-8")) !== $session->password) {
                $form->addError("pw2", PW_ER);
            } else {
                $database->updateUserField($session->uid, 'alliance', 0, 1);
                $database->deleteAlliPermissions($session->uid);
                // log the notice
                $database->deleteAlliance($session->alliance);
                $database->insertAlliNotice($session->alliance, '<a href="spieler.php?uid=' . $session->uid . '">' . $database->RemoveXSS($session->username) . '</a> ' . ALLIANCE44 . '.');
                header("Location: spieler.php?uid=" . $session->uid);
            }

    }

    private function changediplomacy($post)
    {
        global $database, $session, $form;

            $aName = $database->filterstringvalue($post['a_name']);
            $aType = intval($post['dipl']);
            if ($database->aExist($aName, "tag",$session->alliance)) {
                if ($database->getAllianceID($aName) != $session->alliance) {
                    if ($aType >= 1 and $aType <= 3) {
                        if (!$database->diplomacyInviteCheckFixed($database->getAllianceID($aName), $session->alliance)) {

                            $database->diplomacyInviteAdd($session->alliance, $database->getAllianceID($aName), $aType);
                            $notice = '';
                            if ($aType == 1) {
                                $notice = ALLIANCE45;
                            } else if ($aType == 2) {
                                $notice = ALLIANCE46;
                            } else if ($aType == 3) {
                                $notice = ALLIANCE47;
                            }
                            $database->insertAlliNotice($session->alliance, '<a href="allianz.php?aid=' . $session->alliance . '">' . $database->getAllianceName($session->alliance) . '</a> ' . $notice . ' <a href="allianz.php?aid=' . $database->getAllianceID($aName) . '">' . $aName . '</a>.');
                            $form->addError("name", ALLIANCE48);
                        } else {
                            $form->addError("name", ALLIANCE49);
                        }

                    } else {
                        $form->addError("name", ALLIANCE50);
                    }
                }
            } else {
                $form->addError("name", ALLIANCE51);
            }

    }
}

$alliance = new Alliance;


