<?php 
/*
    By iRedux - https://www.facebook.com/opito8
*/
Class Support{
    function newsupport($post){
        global $database, $form;
        $post = filter_var_array($post, FILTER_SANITIZE_STRING);

        //
        $gWorld = array(SPEED.'x - '.HOMEPAGE, 'i_do_not_know');
        $cType = array('general_querstions', 'i_can_not_login', 'i_can_not_register');

        if(!in_array($post['support']['gameworld'], $gWorld)){
            $form->addError("gameworld",'Please select a server');
        }

        if(!in_array($post['support']['supportType'], $cType)){
            $form->addError("supportType",'Please select a category');
        }

        if(empty($post['support']['username'])){
            $form->addError("username",'Please enter a name');
        }else{
            if($post['support']['username']){
				if(strlen($post['support']['username']) < 4) {
					$form->addError("name",USRNM_SHORT);
				}
				if(strlen($post['support']['username']) > 15) {
					$form->addError("name",'Name length');
				}
            }
        }

        if(empty($post['support']['email'])){
            $form->addError("email",'Please enter an e-mail');
        }else{
            if(!$this->validEmail($post['support']['email'])) {
				$form->addError("email",EMAIL_INVALID);
			}
        }

        if(empty($post['support']['message'])){
            $form->addError("message",'Please enter message');
        }else{
            if(strlen($post['support']['message']) > 1000) {
                $form->addError("name",'message Too long');
            }
        }

        if($form->returnErrors() > 0) {
			$_SESSION['errorarray'] = $form->getErrors();
			$_SESSION['valuearray'] = $_POST;
			header("Location: support.php");
            //exit;
		}else{
            $database->query('INSERT INTO support VALUES(NULL,"'.$post['support']['gameworld'].'","'.$post['support']['username'].'","'.$post['support']['email'].'","'.$post['support']['supportType'].'","'.strip_tags($post['support']['message']).'",'.time().')');
            header("Location: support.php?success=1"); exit;
        }

    }

    private function validEmail($email) {
        $regexp="/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i";
        if ( !preg_match($regexp, $email) ) {
             return false;
        }
        return true;
      }
  
}

$support = new Support;