# reCAPTCHA

Simple PHP class for reCAPTCHA verification.  Can be used to easily work into any framework, or by itself.

Get your SITE & SERVER KEY here: https://www.google.com/recaptcha/

## Setup / How To Use

### Server-side
```php
require('class.recaptcha.php');
$recaptcha = new recaptcha('your_SITE_KEY', 'your_SECRET_KEY');		
if(!$recaptcha->response()):
	print 'Sorry, you failed the reCAPTCHA';
else:
	// All your form processing here.
endif;
```

### Client-side

If possible, paste this snippet before the closing `</head>` tag.

```php
$recaptcha->script();
```

Put this at the end of the form where you want the reCAPTCHA widget to appear.

```php
$recaptcha->widget();
```

You can optionally add different parameters to the 'widget' method.  _Shown below._ 

```php
$recaptcha->widget('dark', 'compact');
// 1st param - 'light' is default (light|dark)
// 2nd param - 'normal' is default (normal|compact)
```
