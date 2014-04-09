Router
========

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/algorit/router/badges/quality-score.png?s=1de2383d7b620fb7971c86416feec1ba04b4fb11)](https://scrutinizer-ci.com/g/algorit/router/) [![Coverage Status](https://coveralls.io/repos/algorit/router/badge.png)](https://coveralls.io/r/algorit/router)

A Laravel Package to route domains and register service providers dynamically.

* White and blacklist
* Route by domain
* Route by providers

## Quickstart

Add `algorit/router` as a requirement to `composer.json`:

```
{
    "require": {
        "algorit/router": "dev-master"
    }
}
```

Update your packages running `composer update` 

In your `config/app.php` add the provider to the `providers` array

```
'providers' => array(

    'Algorit\Router\RouterServiceProvider',

),
```

At the end of `config/app.php` add our facade to the `aliases` array

```
'aliases' => array(

    'Router'    => 'Algorit\Router\Facades\Router',

),
```

## Usage

Domains:
```php
Router::domain(function($domain)
{
	// Get the current domain
	// $domain->getRoot();

	$domain->is('http://mystore.com', function()
	{	
		// Register a provider / module
		App::register('Application\Modules\Store\StoreServiceProvider');

		// Or call Laravel Route and register the routes for this domain
	});
});
```

Lists:
```php
// Add to whitelist list
Router::getList()->add('whitelist', 'ip');

// Get whitelisted IPs
Router::getList()->get('whitelist');

// Route only for whitelisted ips
Router::whitelist(function()
{
	// Call a provider or Laravel Route
});
```