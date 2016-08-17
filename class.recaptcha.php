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


	class recaptcha{
		
		private $secretKey;
		private $siteKey;
		
		
		public function __construct($_siteKey=false, $_secretKey=false){
			if(!$_siteKey)
				throw new Exception(__CLASS__.': Missing site key.');
			if(!$_secretKey)
				throw new Exception(__CLASS__.': Missing secret key.');
			$this->secretKey = $_secretKey;
			$this->siteKey = $_siteKey;
		}
		
		
		private function fields(){
			$data = array(
				'secret' => $this->secretKey,
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
		
		
		public function script(){
			print '<script src="https://www.google.com/recaptcha/api.js"></script>';
		}
		
		
		/**
		 *	@param	string	$theme	'light' || 'dark'
		 *	@param	string	$size	'normal' (wide) || 'compact' (square)
		 */
		public function widget($theme='light', $size='normal'){
			print '<div class="g-recaptcha" data-sitekey="'.$this->siteKey.'" data-theme="'.$theme.'" data-size="'.$size.'"></div>';
		}
		
	}

?>
