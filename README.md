Fuel-Github
===========

Fuel GitHub API wrapper influenced by http://travis-ci.org/KnpLabs/php-github-api 

A simple Object Oriented wrapper for GitHub API, written with PHP5.

Uses [GitHub API v3](http://developer.github.com/v3/). The object API is very similar to the RESTful API.


## Basic usage

Firstly add the Github package to your FuelPHP app and then autoload it in your app config 

```php
<?php

$client = new Github\Client();
$user_details = $client->api('user')->show('digitales');
```

From `$client` object, you can call the different API calls.

More documentation to follow, but please take a browse through the code and the [GitHub API v3](http://developer.github.com/v3/)