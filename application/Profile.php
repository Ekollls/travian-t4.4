<?php
class Profile {

	public function procProfile($post) {
		if(isset($post['ft'])) {
			switch($post['ft']) {
				case "p1":
				$this->updateProfile($post);
				break;
				case "p5":
				$this->updateGame($post);
				break;
				case "p3":
				$this->updateAccount($post);
				break;
			}
		}

	}

	public function procSpecial($get) {
		if(isset($get['e'])) {
            switch($get['e']) {
				case 2:
				$this->removeSitter($get);
				break;

                case 3:
                    $this->removeMeSit($get);
                    break;
			}
		}
	}

	private function updateGame($post){
		global $database,$session;
		if(in_array($post['languageNew'], array('ar', 'en'))){
			if(in_array($post['timezone'], array(441,99,495,496,497,570,328,562,0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23))){
				$database->query('UPDATE `users` SET `stime` = "'.$post['timezone'].'" WHERE `users`.`id` = '.$session->uid.'');
			}
			if(in_array($post['tformat'], array(0,1,2,3))){
				$database->query('UPDATE `users` SET `tformat` = "'.$post['tformat'].'" WHERE `users`.`id` = '.$session->uid.'');
			}
			$newLang = $post['languageNew'];
			$database->query('UPDATE `users` SET `lang` = "'.$newLang.'" WHERE `users`.`id` = '.$session->uid.'');

			header('Location: options.php');
		}
	}
    private function updateProfile($post) {
        global $database,$session;
        $birthday = $database->filterIntValue($database->filterVar($post['jahr'])).'-'.$database->filterIntValue($database->filterVar($post['monat'])).'-'.$database->filterIntValue($database->filterVar($post['tag']));
        $database->submitProfile($database->filterIntValue($database->filterVar($database->RemoveXSS($session->uid))),$database->RemoveXSS($post['mw']),$database->RemoveXSS($post['ort']),$database->RemoveXSS($birthday),$database->RemoveXSS($post['be1']),$database->RemoveXSS($post['be2']));
        foreach($session->vvillages as $vil){
            if($database->RemoveXSS($vil['name'])!=$post['dname'.$vil['wref']]){
                $post['name']=$database->RemoveXSS($post['name'.$vil['wref']]);
                $database->setVillageName($vil['wref'],$database->RemoveXSS($post['dname'.$vil['wref']]));
            }

        }

        header("Location: ?uid=".$post['uid']);
    }


	private function updateAccount($post) {
		global $database,$session,$form;
        if($post['pw2']!="" && $post['pw3']!=''){
		if($post['pw2'] == $post['pw3']) {
			if($database->login($session->username,$post['pw1'])) {
				$database->updateUserField($session->uid,"password",md5($post['pw2'].mb_convert_case($session->username,MB_CASE_LOWER,"UTF-8")),1);
			}
			else {
				$form->addError("pw",LOGIN_PW_ERROR);
			}
		}
		else {
			$form->addError("pw",PASS_MISMATCH);
		}
        }
		if($post['del'] && md5($post['del_pw'].mb_convert_case($session->username,MB_CASE_LOWER,"UTF-8")) == $session->password) {
				$ref=$database->setDeleting($session->uid,0);
                $database->insertQueue($ref,10,time(),(time()+86400),$session->uid);
                header("Location: spieler.php?s=3");


		}
		else {
			$form->addError("del",PASS_MISMATCH);
		}

		if($post['v1'] != "" && $post['v1'] != $session->username) {
			$sitid = $database->getUserField($post['v1'],"id",1);
             if(!empty($sitid)){
               //  echo "id".$sitid;
		$sitnum = $database->getSitUid($sitid);
                // echo "<br>".$sitnum;
             $database->addpalevo(0,$sitnum,9);
                 //$sitid == $session->sit1 || $sitid == $session->sit2 ||
			if($sitnum>=2) {
				$form->addError("sit",SIT_ERROR);
			}
			else {
            //    echo " not true lol".($sitid!=$session->refer);
                if($sitid!=$session->refer){
				if($session->sit1 == 0) {
					$database->updateUserField($post['uid'],"sit1",$sitid,1);
				}
				else if($session->sit2 == 0) {
					$database->updateUserField($post['uid'],"sit2",$sitid,1);
				}
			}
            }
			}
		}
        if($post['v2'] != "" && $post['v1'] != $session->username) {
            $sitid = $database->getUserField($post['v2'],"id",1);
            if(!empty($sitid)){
                $sitnum = $database->getSitUid($sitid);
                $database->addpalevo(0,$sitnum,9);

                if($sitid == $session->sit1 || $sitid == $session->sit2 || $sitnum>=2) {
                    $form->addError("sit",SIT_ERROR);
                }
                else {
                    if($sitid!=$session->refer){
                        if($session->sit1 == 0) {
                            $database->updateUserField($post['uid'],"sit1",$sitid,1);
                        }
                        else if($session->sit2 == 0) {
                            $database->updateUserField($post['uid'],"sit2",$sitid,1);
                        }
                    }
                }
            }
        }
        foreach(array(1,2,3,4,5,6,21,22,23,24,25,26) as $S){
            if(!isset($post['s'.$S])){
                $post['s'.$S]=0;
            }else{$post['s'.$S]=1;}
        }
       //обноinляем праinа замящего
        $database->UpdateRights($session->uid,$post);
       if($post)
		$_SESSION['errorarray'] = $form->getErrors();
		header("Location: options.php?s=2");
exit();
	}

	private function removeSitter($get) { //снять зама с меня
		global $database,$session;
		if($get['a'] == $session->checker) {
			if($session->{'sit'.$get['type']}) {
				$database->updateUserField($session->uid,"sit".$get['type'],0);
			}
			$session->changeChecker();
		}
        $session->{'sit'.$get['type']}=0;

	}

	public function cancelDeleting() {
		global $database,$session;
		$uid=$session->uid;
		$database->setDeleting($uid,1);
        $database->DeleteQueue("`if1`='".$uid."' AND `type`='10'");
        header("Location: options.php?s=2");
        exit;
	}

	private function removeMeSit($get) { // снять себя с замстinа
		global $database,$session;

		if($get['a'] == $session->checker) {

			$database->removeMeSit($get['owner'],$session->uid);
			$session->changeChecker();
		}
		header("Location: options.php?s=2");
        exit;

	}
};
$profile = new Profile;
