<?php

namespace Github\Api\Current_User;

use Github\Api\Abstract_Api;

/**
 * @link   http://developer.github.com/v3/repos/watching/
 * @author Ross Tweedie <ross.tweedie at gmail dot com>
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
class Watchers extends Abstract_Api
{
    /**
     * List repositories watched by the authenticated user
     * @link http://developer.github.com/v3/repos/watching/
     *
     * @param  integer  $page
     * @return array
     */
    public function all($page = 1)
    {
        return $this->get('user/watched', array(
            'page' => $page
        ));
    }

    /**
     * Check that the authenticated user watches a repository
     * @link http://developer.github.com/v3/repos/watching/
     *
     * @param  string  $username         the user who owns the repo
     * @param  string  $repository       the name of the repo
     * @return array
     */
    public function check($username, $repository)
    {
        return $this->get('user/watched/'.urlencode($username).'/'.urlencode($repository));
    }

    /**
     * Make the authenticated user watch a repository
     * @link http://developer.github.com/v3/repos/watching/
     *
     * @param  string  $username         the user who owns the repo
     * @param  string  $repository       the name of the repo
     * @return array
     */
    public function watch($username, $repository)
    {
        return $this->put('user/watched/'.urlencode($username).'/'.urlencode($repository));
    }

    /**
     * Make the authenticated user unwatch a repository
     * @link http://developer.github.com/v3/repos/watching/
     *
     * @param  string  $username         the user who owns the repo
     * @param  string  $repository       the name of the repo
     * @return array
     */
    public function unwatch($username, $repository)
    {
        return $this->delete('user/watched/'.urlencode($username).'/'.urlencode($repository));
    }
}
