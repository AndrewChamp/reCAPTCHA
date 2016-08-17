<?php

/**
 * The MIT License (MIT)
 * Copyright (c) 2016 Andrew Champ | https://google.com/+AndrewChamp
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software
 * and associated documentation files (the "Software"), to deal in the Software without restriction, 
 * including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, 
 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, 
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial 
 * portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT 
 * LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN
 * NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, 
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE 
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

	/**
	 *
	 *	EXAMPLE USAGE:
	 *
	 *	// Get your secret key here: https://www.google.com/recaptcha/
	 *
	 *	require('class.recaptcha.php');
	 *	$recaptcha = new recaptcha('your_Secret_Key_From_Recaptcha');		
	 *	if(!$recaptcha->response()):
	 *		print 'Sorry, you failed the reCAPTCHA';
	 *	else:
	 *		// All your form processing here.
	 *	endif;
	 *
	 */

	class recaptcha{
		
		private $secret;
		
		public function __construct($_secret=false){
			if(!$_secret)
				throw new Exception(__CLASS__.': Missing secret key.');
			$this->secret = $_secret;
		}
		
		private function fields(){
			$data = array(
				'secret' => $this->secret,
				'response' => $_POST["g-recaptcha-response"],
				'remoteip' => $_SERVER['REMOTE_ADDR']
			);
			return $data;
		}
		
		private function send(){
			$verify = curl_init();
			curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
			curl_setopt($verify, CURLOPT_POST, true);
			curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($this->fields()));
			curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($verify);
			$captcha = json_decode($response);
			return $captcha->success;
		}
		
		public function response(){
			return $this->send();
		}
	}

?>
