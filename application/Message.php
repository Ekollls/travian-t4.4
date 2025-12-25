<?php
class Message {

	public $unread, $nunread = false;

	public $inbox, $inbox1, $sent, $sent1, $reading, $reply,  $noticearray, $notice = array();
	private $totalMessage;

	function __construct() {
		$this->getMessages();

		if(isset($_SESSION['reply'])) {
			$this->reply = $_SESSION['reply'];
			unset($_SESSION['reply']);
		}
	}

	public function procMessage($post) {
		global $database,$generator,$session;
		if(isset($post['ft'])) {
            $post['id']=$database->filterintvalue($post['id']);
			switch($post['ft']) {
				case "m1":
					$this->quoteMessage($post['id']);
					break;
				case "m2":
                    if(isset($_SESSION['username'])){
                        if($post['key']==$_SESSION['mescheck']){
				if ($post['an'] == "[ally]" || $post['an'] == '[ally]; [ally]'){
					$this->sendAMessage($post['be'],$database->RemoveXSS($post['message']));
					}else{
						$this->sendMessage($post['an'],$post['be'],$database->RemoveXSS($post['message']));
					}
                            $_SESSION['mescheck']=$generator->generateRandStr(3);
                    }
                    }
				//header("Location: nachrichten.php?t=2");exit();
					break;
				case "m3":
				case "m4":
				case "m5":
					if(isset($post['delmsg_x']) && $session->right['s6']) {
						$this->removeMessage($post);
					}

					if(isset($_POST['realAll'])){
						$this->readMessages($post);
					}

					break;

			}
		}
	}




	public function quoteMessage($id) {
		foreach($this->inbox as $message) {
			if($message['id'] == $id) {
			$message = preg_replace('/\[message\]/', '', $message);
			$message = preg_replace('/\[\/message\]/', '', $message);
				$this->reply = $_SESSION['reply'] = $message;
				header("Location: nachrichten.php?t=1&id=" . $message['owner']);exit();
			}
		}
	}

	public function loadMessage($id) {
		global $database;
		if($this->findInbox($id)) {
			foreach($this->inbox as $message) {
				if($message['id'] == $id) {
					$this->reading = $message;
				}
			}
		}
		if($this->findSent($id)) {
			foreach($this->sent as $message) {
				if($message['id'] == $id) {
					$this->reading = $message;
				}
			}
		}

		if($this->reading['viewed'] == 0 && !$_SESSION['adminLogin']) {
			$database->getMessage($id, 4,$_SESSION['id_user']);
		}
	}



	private function removeMessage($post) {
		global $database;
		for($i = 1; $i <= 10; $i++) {
			if(isset($post['n' . $i])) {

                $post['n' . $i]=$database->filterintvalue($post['n' . $i]);
                $p=array('n'=>$post['n'.$i]);
			$message1 = $database->query("SELECT * FROM mdata where id = :n",$p);
			$message = $message1[0];
			if($message['target'] == $_SESSION['id_user'] && $message['owner'] == $_SESSION['id_user']){
				$database->getMessage($post['n' . $i], 8);
			}else if($message['target'] == $_SESSION['id_user']){
				$database->getMessage($post['n' . $i], 5);
			}else if($message['owner'] == $_SESSION['id_user']){
				$database->getMessage($post['n' . $i], 7);
			}
			}
		}
		/*if(isset($_GET['t']) && $_GET['t'] == 2){
			header("Location: nachrichten.php?t=2");
		}*/
        header("Location: nachrichten.php");
	}

	
	private function readMessages($post) {
		global $database;
		for($i = 1; $i <= 10; $i++) {
			if(isset($post['n' . $i])) {
                $database->query("UPDATE mdata SET viewed = 1 WHERE id = ".$post['n'.$i]."");
			}
		}
        header("Location: nachrichten.php".($post['page'] ? '?s='.$post['page'].'' : '')."");
	}









	private function getMessages() {
		global $database;
		$this->inbox = $database->getMessage($_SESSION['id_user'], 1);
		$this->sent = $database->getMessage($_SESSION['id_user'], 2);
		$this->inbox1 = $database->getMessage($_SESSION['id_user'], 9);
		$this->sent1 = $database->getMessage($_SESSION['id_user'], 10);

		$this->totalMessage = count($this->inbox) + count($this->sent);
	}

	private function sendAMessage($topic,$text) {
		global $database;
		$alli=$_SESSION['alliance_user'];
		$uid=$_SESSION['id_user'];
		$allmembersQ = $database->query("SELECT id FROM users WHERE alliance='".$alli."'");
		$userally = $alli;
		$perm0=$database->query("SELECT opt7 FROM ali_permission WHERE uid='".$uid."'");
		$permission=$perm0[0];
		if($topic == "") {
			$topic = "No subject";
		}
		if(!preg_match('/\[message\]/',$text) && !preg_match('/\[\/message\]/',$text)){
			
		$text = "[message]".$text."[/message]";
		$alliance = $player = $coor =  0;
			if($permission['opt7']==1){
				//if ($userally != 0) {
					foreach ($allmembersQ as $allmembers ) {
						$database->sendMessage($allmembers['id'],$_SESSION['id_user'],$topic,$text,0,$alliance,$player,$coor);
						header('Location: nachrichten.php?t=2');
					}
				}
			//}
		}
	}

	public function isIgnored($uid){
		global $database, $session;
		if($database->queryFetch('SELECT COUNT(*) AS num FROM `ignore` WHERE `uignored` = '.$session->uid.' AND `uid` = '.$uid.'')['num'] == 0){
			return FALSE;
		}else{
			return TRUE;
		}
	}

	private function sendMessage($recieve, $topic, $text) {
		global $database,$session,$form;
		// check if is ignored
		
        if(!empty($recieve)){
			$user = $database->getUserField($recieve, "id", 1);
			
			if($this->isIgnored($user) && $session->access != 9){
				$form->addError("user",'You cannot send messages for this player, the player has added you to BlackList');
				$_SESSION['errorarray'] = $form->getErrors();
			}else{
				if($user>0){
					if($topic == "") {
						$topic = "Without a subject";
					}

					if(!preg_match('/\[message\]/',$text) && !preg_match('/\[\/message\]/',$text)){
						$text = "[message]".$text."[/message]";
						$alliance = $player = $coor =  0;

						$database->sendMessage($user, $_SESSION['id_user'], $topic, $text, 0, $alliance, $player, $coor);
						header('Location: nachrichten.php?t=2');
					}
				}

			}
        }
	}

	//7 = village, attacker, att tribe, u1 - u10, lost %, w,c,i,c , cap
	//8 = village, attacker, att tribe, enforcement




	private function findInbox($id) {
		foreach($this->inbox as $message) {
			if($message['id'] == $id) {
				return true;
			}
		}
		return false;
	}

	private function findSent($id) {
		foreach($this->sent as $message) {
			if($message['id'] == $id) {
				return true;
			}
		}
		return false;
	}





}

$message = new Message;