<?php

namespace Github\Api\Repository;

use Github\Api\Abstract_Api;

/**
 * @link   http://developer.github.com/v3/repos/commits/
 * @author Ross Tweedie <ross.tweedie at gmail dot com>
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
class Commits extends Abstract_Api
{
    public function all($username, $repository, array $params = array() )
    {
        // The all method supports pagination, so let's also retrieve the response headers
        return $this->get('repos/'.urlencode($username).'/'.urlencode($repository).'/commits', $params, array( 'include_headers' => true ) );
    }

    public function compare($username, $repository, $base, $head)
    {
        return $this->get('repos/'.urlencode($username).'/'.urlencode($repository).'/compare/'.urlencode($base).'...'.urlencode($head));
    }

    public function show($username, $repository, $sha)
    {
        return $this->get('repos/'.urlencode($username).'/'.urlencode($repository).'/commits/'.urlencode($sha));
    }
}
