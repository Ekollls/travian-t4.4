<?php 

include('application/Account.php');
include('application/library/Paypal/paypal.class.php');

	// Payment success or nah
	if(isset($_GET['success'])){
		if(!isset($_POST['PAYMENT_ID']) || !isset($_POST['PAYEE_ACCOUNT']) || !isset($_POST['PAYMENT_AMOUNT']) || !isset($_POST['PAYMENT_UNITS']) || !isset($_POST['PAYMENT_BATCH_NUM']) || !isset($_POST['PAYER_ACCOUNT']) || !isset($_POST['TIMESTAMPGMT'])){			
			$response = $Paypal->request('GetExpressCheckoutDetails', array(
				'TOKEN' => $_GET['token']
			));
				
			// check if the response if TRUE of 0
			if ($response) {
				if ($response['CHECKOUTSTATUS'] == 'PaymentActionCompleted') {
					die('Error');
					}
			} else { // Error  !
				die('Error!');
			}
				
			// add the payment data and the new fundus to user account
			$params = array(
				'TOKEN' => $_GET['token'],
				'PAYERID' => $_GET['PayerID'],
				'PAYEMENTACTION' => 'Sale',
				'PAYMENTREQUEST_0_AMT' => $_SESSION['cost'],
				'PAYMENTREQUEST_0_CURRENCYCODE' => 'USD',
				'PAYMENTREQUEST_0_SHIPPINGAMT' => 0,
				'PAYMENTREQUEST_0_ITEMAMT' => $_SESSION['cost'],
			);
			$response = $Paypal->request('DoExpressCheckoutPayment', $params);
			if($response['PAYMENTINFO_0_TRANSACTIONID'] != ''){
				$database->query("INSERT INTO payments VALUES(NULL,'Paypal','".$response['PAYMENTINFO_0_TRANSACTIONID']."',".time().",".$session->uid.",".$_SESSION['goldAmount'].",'".$_SESSION['cost']."')");
				$database->query("UPDATE users set gold = gold + ".$_SESSION['goldAmount']." where id = ".$session->uid."");
				$database->sendMessage($session->uid, 6, 'Account charged: ', "New sold".($session->gold + $_SESSION['goldAmount']), 0, 0, 0, 0,0);
				$database->sendMessage(6, 6, 'Renewed shipping','player "'.$session->username.'" -> '.$_SESSION['goldAmount'].' gold '.$_SESSION['cost'].'. '.$session->gold.' '.($session->gold + $_SESSION['goldAmount']).'.', 0, 0, 0, 0,0);
				echo "Gold has been shipped, you can close this page"; die();
			}else{
				echo "There is a problem with the payment currency, try again."; die();
			}
		}
			
		unset($_SESSION['goldAmount']);
		unset($_SESSION['cost']);
	}elseif(isset($_GET['error'])){
		echo "erreur";
		
	}else{ // Paypal redirect
		if(isset($_GET) && !empty($_GET)){
			foreach($packages as $package){
				if($package['id'] == $_GET['product']){
					$_SESSION['goldAmount'] = $package['gold'];
					$_SESSION['cost'] = $package['cost'];

					$params = array(
						'RETURNURL' => HOMEPAGE.'tgpay.php?success',
						'CANCELURL' => HOMEPAGE.'tgpay.php?error',
						'PAYMENTREQUEST_0_AMT' => $package['cost'],
						'PAYMENTREQUEST_0_CURRENCYCODE' => $package['currency'],
					);
					$response = $Paypal->request('SetExpressCheckout', $params);
					if ($response) {
						header('Location: '.$Paypal->getUrl($response).'');
					} else {
						die("Cannot get response");
					}

				}
			}
		}
 } 
?>