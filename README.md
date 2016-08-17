# reCAPTCHA
==================

Simple PHP class for reCAPTCHA verification.  Can be used to easily work into any framework, or by itself.

## Setup / How To Use

### Server-side
```php
// Get your secret key here: https://www.google.com/recaptcha/

require('class.recaptcha.php');
$recaptcha = new recaptcha('your_SECRET_Key_From_Recaptcha');		
if(!$recaptcha->response()):
	print 'Sorry, you failed the reCAPTCHA';
else:
	// All your form processing here.
endif;
```

### Client-side
#### File
Paste this snippet before the closing </head> tag.
```html
<script src="https://www.google.com/recaptcha/api.js"></script>
```
#### Your Form
Paste this snippet at the end of the form where you want the reCAPTCHA widget to appear.
```html
<div class="g-recaptcha" data-sitekey="your_SITE_key"></div>
```
