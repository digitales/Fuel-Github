<?php
/**
 * 
 */

Autoloader::add_classes(array(

	'GitHub\\Exception_Api_Limit'           => __DIR__.'/classes/exception/api/limit.php',
    'GitHub\\Exception_Argument_Invalid'    => __DIR__.'/classes/exception/argument/invalid.php',
    'GitHub\\Exception_Argument_Missing'    => __DIR__.'/classes/exception/argument/missing.php',
    
    'GitHub\\Client'                        => __DIR__.'/classes/client.php',
    
    'GitHub\\Api\\Api_Interface'                => __DIR__.'/classes/api/interface.php',
    'GitHub\\Api\\Abstract_Api'             => __DIR__.'/classes/api/abstract/api.php',
    'GitHub\\Api\\User'                     => __DIR__.'/classes/api/user.php',
    
	
    
    User
));

/* End of file bootstrap.php */