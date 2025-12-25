<?php

class Paypal{

	private $user;
	private $pwd;
	private $signature;
	
	public $endpoint;
	public $errors	=	array();

	public static $instances = 0;

	
	public function __construct($user=false,$pwd=false,$signature=false,$prod=false){
		global $config;

		$this->user= $config['paypalAPIUser'];
		$this->pwd = $config['paypalAPIPwd'];
		$this->signature = $config['paypalAPISign'];

		switch($config['paypalStatus']){
			case "live":
			$this->endpoint = "https://api-3t.paypal.com/nvp";
			break;
			
			case "sandbox":
			$this->endpoint = "https://api-3t.sandbox.paypal.com/nvp";
			break;
		}
		//if($prod) $this->endpoint = str_replace('sandbox.','',$this->endpoint);
		// self::$instances++;
	}

	public function request($method,$params){
		$params	= array_merge($params,array(
				'METHOD'		=>	$method,
				'VERSION'		=>	'74.0',
				'USER'			=>	$this->user,
				'SIGNATURE'		=>	$this->signature,
				'PWD'			=>	$this->pwd
		));

		$params = http_build_query($params);

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL		=>	$this->endpoint,
			CURLOPT_POST	=>	1,
			CURLOPT_POSTFIELDS	=>	$params,
			CURLOPT_RETURNTRANSFER	=>	1,
			CURLOPT_SSL_VERIFYPEER	=>	false,
			CURLOPT_SSL_VERIFYHOST	=>	false,
			CURLOPT_VERBOSE			=>	1
		));

		$response = curl_exec($curl);
		$responseArray = array();

		parse_str($response,$responseArray);

		if(curl_errno($curl)){
			$this->errors = curl_error($curl);
			curl_close($curl);
			return false;
		}else{
			if($responseArray['ACK']=='Success'){
				return $responseArray;
			}else{
				$this->errors = $responseArray;
				curl_close($curl);
				return false;
			}
		}
		
	}

	public function getUrl($response){
		global $config;

		switch($config['paypalStatus']){
			case "live":
			return '/paypal.php';
			break;
			
			case "sandbox":
			return '/paypal.php';
			break;
			}
		}
	}



$Paypal = new Paypal;
?>