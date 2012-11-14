Fuel-Github
===========

Fuel GitHub API wrapper influenced by http://travis-ci.org/KnpLabs/php-github-api 

A simple Object Oriented wrapper for GitHub API, written with PHP5.

Uses [GitHub API v3](http://developer.github.com/v3/). The object API is very similar to the RESTful API.

## Installation

1. Clone this repo into the `packages` directory:

		cd fuel/packages
		git clone git://github.com/digitales/Fuel-Github.git

2. Create a Github config file, aptly-named `github.php` in your `app/config` directory, with the following standard:

```php
<?php

// app/config/github.php

return array(
	'active' => 'default',
	'default' => array(
	    // No trailing slash!
	    'api_url' => 'https://api.github.com',

	    'consumer_key' => 'your-consumer-key-here',

	    'consumer_secret' => 'your-consumer-secret-here',
	
	    'callback' => 'http://myapp.local/path/to/callback',
	    
	    // To be removed:
	    'redirect_url' => '',
 	),
);
```


## Basic usage

```php
<?php

$client = new Github\Client();
$user_details = $client->api('user')->show('digitales');
```

From `$client` object, you can call the different API calls.

More documentation to follow, but please take a browse through the code and the [GitHub API v3](http://developer.github.com/v3/)