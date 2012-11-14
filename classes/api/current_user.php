<?php

namespace Github\Api;

use Github\Api\Abstract_Api;
use Github\Api\Current_User\Emails;
use Github\Api\Current_User\Followers;
use Github\Api\Current_User\Watchers;
use Github\Api\Current_User\Deploy_Keys;

/**
 * @link   http://developer.github.com/v3/users/
 * @author Ross Tweedie <ross.tweedie at gmail dot com>
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
class Current_User extends Abstract_Api
{
    public function show()
    {
        return $this->get('user');
    }

    public function update(array $params)
    {
        return $this->patch('user', $params);
    }

    /**
     * @return Deploy_Keys
     */
    public function keys()
    {
        return new Deploy_Keys($this->client);
    }

    /**
     * @return Emails
     */
    public function emails()
    {
        return new Emails($this->client);
    }

    /**
     * @return Followers
     */
    public function follow()
    {
        return new Followers($this->client);
    }

    public function issues(array $params = array())
    {
        // The all method supports pagination, so let's also retrieve the response headers
        return $this->get('issues', array_merge(array('page' => 1), $params), array( 'include_headers' => true ) );
    }

    public function followers($page = 1)
    {
        // The all method supports pagination, so let's also retrieve the response headers
        return $this->get('user/followers', array( 'page' => $page ), array( 'include_headers' => true ) );
    }

    /**
     * @return Watchers
     */
    public function watchers()
    {
        return new Watchers($this->client);
    }

    public function watched($page = 1)
    {
        return $this->get('user/watched', array( 'page' => $page ), array( 'include_headers' => true ) );
    }
}
