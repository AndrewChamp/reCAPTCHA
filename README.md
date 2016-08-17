# reCAPTCHA
==================

Simple PHP class for reCAPTCHA verification.  Can be used to easily work into any framework, or by itself.

## How To Use

```php
// Get your secret key here: https://www.google.com/recaptcha/

require('class.recaptcha.php');
$recaptcha = new recaptcha('your_Secret_Key_From_Recaptcha');		
if(!$recaptcha->response()):
	print 'Sorry, you failed the reCAPTCHA';
else:
	// All your form processing here.
endif;
```
