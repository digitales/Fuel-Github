<?php

namespace Github;

use Github\Api;
use Github\Api\Api_Interface;

use Fuel\Core\Request;
use Fuel\Core\Request_Curl;


/**
 * Simple FuelPHP Github client
 *
 * @author Ross Tweedie <r.tweedie@gmail.com>
 * 
 * Website: http://github.com/digitales/Fuel-Github
 */
class Client
{
    /**
     * Constant for authentication method. Indicates the default, but deprecated
     * login with username and token in URL.
     */
    const AUTH_URL_TOKEN = 'url_token';

    /**
     * Constant for authentication method. Indicates the new favored login method
     * with username and password via HTTP Authentication.
     */
    const AUTH_HTTP_PASSWORD = 'http_password';

    /**
     * Constant for authentication method. Indicates the new login method with
     * with username and token via HTTP Authentication.
     */
    const AUTH_HTTP_TOKEN = 'http_token';
    
    
    protected static $_user, $_api_token, $_url, $_driver;
    protected static $_consumer_key, $_consumer_secret, $_callback;
    protected static $_redirect_url, $_api_url;
    
    protected $options, $params;

    
    /**
     * The httpClient instance used to communicate with GitHub
     *
     * @var HttpClientInterface
     */
    private $client = null;

    /**
     * The list of loaded API instances
     *
     * @var array
     */
    private $apis = array();

    /**
     * HTTP Headers
     *
     * @var array
     */
    private $headers = array();

    /**
     * Instantiate a new GitHub client
     *
     * @param HttpClientInterface $httpClient custom http client
     */
    public function __construct( )
    {
        if ( !isset( static::$_url ) || static::$_url =='' ){
            $this->setup();
        }
    }
    
    /**
     * Set up the client with the config settings
     *
     * @param null
     * @return Github\Client fluent interface
     */
    public function setup()
    {
        $config = \Config::load('github', true);

        static::$_url               = $config[ $config['active'] ]['api_url'];
        static::$_consumer_key      = $config[ $config['active'] ]['consumer_key'];
        static::$_consumer_secret   = $config[ $config['active'] ]['consumer_secret'];
        static::$_callback          = $config[ $config['active'] ]['callback'];
        static::$_redirect_url      = $config[ $config['active'] ]['redirect_url'];
        static::$_api_url           = $config[ $config['active'] ]['api_url'];
        
        // We need to use the CURL driver for this to work.
        $this->set_option( 'driver', 'curl' );
        
        return $this;
    }
    
    
    /**
	 * Sets options on the driver
	 *
	 * @param   array  $options
	 * @return  Github\Client fluent interface
	 */
	public function set_options(array $options)
	{
		foreach ($options as $key => $val)
		{
			$this->options[$key] = $val;
		}

		return $this;
	}

	
    /**
	 * Sets a single option/value
	 *
	 * @param   int|string $option
	 * @param   mixed $value
	 * @return  Github\Client fluent interface
	 */
	public function set_option($option, $value)
	{
		return $this->set_options(array($option => $value));
	}
    
    
    /**
	 * Sets params for the driver
	 *
	 * @param   array  $options
	 * @return  Github\Client fluent interface
	 */
	public function set_params(array $options)
	{
		foreach ($options as $key => $val)
		{
			$this->params[$key] = $val;
		}

		return $this;
	}

    
	/**
	 * Sets a single param/value
	 *
	 * @param   int|string  $option
	 * @param   mixed       $value
	 * @return  Github\Client fluent interface
	 */
	public function set_param($option, $value)
	{
		return $this->set_params(array($option => $value));
	}
    

    /**
     * Authenticate a user for all next requests
     *
     * @param string      $login  GitHub username
     * @param string      $secret GitHub private token or Github password if $method == AUTH_HTTP_PASSWORD
     * @param null|string $method One of the AUTH_* class constants
     * @return Github\Client fluent interface
     */
    public function authenticate($login, $secret = null, $method = null)
    {
        if ($method === self::AUTH_HTTP_PASSWORD) {
            $this->set_option('login', $login)->set_option('password', $secret);
        } else {    
            $this->set_param('access_token', $secret);
        }
        return $this;
    }
    
    
    /**
     * Prepare the request to be performed
     * Ex: $api->get('repos/show/my-username/my-repo')
     *
     * @param string $path the GitHub path
     * @param array $parameters GET parameters
     * @param array $requestOptions reconfigure the request
     * @param string $method
     * @return array  data to be returned
     */
    protected function prepare_request( $path, array $parameters = array(), $requestOptions = array(), $method = 'get' )
    {
        $url = self::$_url.'/'.$path;
        
        $options = $this->options;
        $options['params']  = array_merge( $this->params, $parameters );   
        
        $response  = Request::forge( $url, $options, $method )->execute()->response();
        
        //echo '$response<pre>'.print_r($response, 1).'</pre>';
        
        if ( isset( $response->body ) ){
            return \Format::forge( $response->body, 'json' )->to_array();
        }else{
            return false;
        }
    }
    

    /**
     * Call any path, GET method
     * Ex: $api->get('repos/show/my-username/my-repo')
     *
     * @param   string  $path            the GitHub path
     * @param   array   $parameters       GET parameters
     * @param   array   $requestOptions   reconfigure the request
     * @return  array                     data returned
     */
    public function get($path, array $parameters = array(), $requestOptions = array())
    {
        return $this->prepare_request( $path, $parameters, $requestOptions, 'get' );
    }

    /**
     * Call any path, POST method
     * Ex: $api->post('repos/show/my-username', array('email' => 'my-new-email@provider.org'))
     *
     * @param   string  $path             the GitHub path
     * @param   array   $parameters       POST parameters
     * @param   array   $requestOptions   reconfigure the request
     * @return  array                     data returned
     */
    public function post($path, array $parameters = array(), $requestOptions = array())
    {
        return $this->prepare_request( $path, $parameters, $requestOptions, 'post' );
    }
    
    
    /**
     * Call any path, PATCH method
     * Ex: $api->patc('repos/show/my-username', array('email' => 'my-new-email@provider.org'))
     *
     * @param   string  $path             the GitHub path
     * @param   array   $parameters       POST parameters
     * @param   array   $requestOptions   reconfigure the request
     * @return  array                     data returned
     */
    public function patch($path, array $parameters = array(), $requestOptions = array())
    {
        return $this->prepare_request( $path, $parameters, $requestOptions, 'post' );
    }
    

    /**
     * Call any path, PUT method
     *
     * @param   string  $path            the GitHub path
     * @param   array   $requestOptions   reconfigure the request
     * @return  array                     data returned
     */
    public function put($path, $requestOptions = array())
    {
        return $this->prepare_request( $path, $parameters, $requestOptions, 'put' );
    }

    /**
     * Call any path, DELETE method
     *
     * @param   string  $path            the GitHub path
     * @param   array   $parameters       DELETE parameters
     * @param   array   $requestOptions   reconfigure the request
     * @return  array                     data returned
     */
    public function delete($path, array $parameters = array(), $requestOptions = array())
    {
        return $this->prepare_request( $path, $parameters, $requestOptions, 'delete' );
    }

    
    /**
     * Get the http client.
     *
     * @return HttpClientInterface a request instance
     */
    public function get_client()
    {
        if ( is_array( $this->headers ) ){
            foreach( $this->headers AS $option => $value ){
                $this->client->set_header( $option, $value );
            }
        } else {
            $this->client->set_header( $this->headers );
        }
        
        return $this->client;
    }
    

    /**
     * Inject another http client
     *
     * @param GitHub\Client $client The client instance
     */
    public function set_client( GitHub\Client $client)
    {
        $this->client = $client;
    }
    

    /**
     * @param string $name
     *
     * @return ApiInterface
     *
     * @throws \InvalidArgumentException
     */
    public function api($name)
    {
        if (!isset($this->apis[$name])) {
            switch ($name) {
                case 'current_user':
                    $api = new Api\Current_User( $this );
                    break;
                
                case 'event':
                    $api = new Api\Event( $this );
                    break;  

                case 'git_data':
                    $api = new Api\Git_Data( $this );
                    break;

                case 'gists':
                    $api = new Api\Gists( $this );
                    break;

                case 'issue':
                    $api = new Api\Issue( $this );
                    break;

                case 'markdown':
                    $api = new Api\Markdown( $this );
                    break;

                case 'organization':
                case 'organisation':
                    $api = new Api\Organisation( $this );
                    break;

                case 'pull_request':
                    $api = new Api\Pull_Request( $this );
                    break;

                case 'repo':
                    $api = new Api\Repository( $this );
                    break;

                case 'user':                    
                    $api = new Api\User( $this );
                    break;

                default:
                    throw new \Exception_Argument_Invalid();
            }

            $this->apis[$name] = $api;
        }

        return $this->apis[$name];
    }

    /**
     * @return mixed
     */
    public function getRateLimit()
    {
        return $this->get('rate_limit');
    }

    /**
     * Clears used headers
     */
    public function clearHeaders()
    {
        $this->setHeaders(array());
    }

    /**
     * @param array $headers
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }
}
