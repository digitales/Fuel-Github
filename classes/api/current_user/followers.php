<?php

namespace Github\Api\Current_User;

use Github\Api\Abstract_Api;

/**
 * @link   http://developer.github.com/v3/users/followers/
 * @author Ross Tweedie <ross.tweedie at gmail dot com>
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
class Followers extends Abstract_Api
{
    /**
     * List followed users by the authenticated user
     * @link http://developer.github.com/v3/repos/followers/
     *
     * @param  integer  $page
     * @return array
     */
    public function all($page = 1)
    {
        return $this->get('user/following', array( 'page' => $page ), array( 'include_headers' => true ));
    }

    /**
     * Check that the authenticated user follows a user
     * @link http://developer.github.com/v3/repos/followers/
     *
     * @param  string  $username         the username to follow
     * @return array
     */
    public function check($username)
    {
        return $this->get('user/following/'.urlencode($username));
    }

    /**
     * Make the authenticated user follow a user
     * @link http://developer.github.com/v3/repos/followers/
     *
     * @param  string  $username         the username to follow
     * @return array
     */
    public function follow($username)
    {
        return $this->put('user/following/'.urlencode($username));
    }

    /**
     * Make the authenticated user un-follow a user
     * @link http://developer.github.com/v3/repos/followers/
     *
     * @param  string  $username         the username to un-follow
     * @return array
     */
    public function unfollow($username)
    {
        return $this->delete('user/following/'.urlencode($username));
    }
}
