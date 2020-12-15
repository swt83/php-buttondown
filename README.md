# ButtonDown

A PHP package for working w/ the ButtonDown API.

## Install

Normal install via Composer.

## Usage

```php
use Travis\ButtonDown;

// api token
$token = 'your-api-token';

// add subscriber
$response = ButtonDown::run($token, 'subscribers', 'POST', [
	'email' => 'foo@bar.net',
]);

// get subscribers list
$response = ButtonDown::run($token, 'subscribers', 'GET', [
	'type' => 'regular',
]);
```

See the [API Guide](https://api.buttondown.email/v1/schema#section/Introduction) for additional methods.