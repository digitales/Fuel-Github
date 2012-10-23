<?php

namespace Github\Api\Repository;

use Github\Api\Abstract_Api;

/**
 * @link   http://developer.github.com/v3/repos/forks/
 * @author Ross Tweedie <ross.tweedie at gmail dot com>
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
class Forks extends Abstract_Api
{
    public function all($username, $repository, array $params = array())
    {
        // The all method supports pagination, so let's also retrieve the response headers

        if (isset($params['sort']) && !in_array($params['sort'], array('newest', 'oldest', 'watchers'))) {
            $params['sort'] = 'newest';
        }

        return $this->get('repos/'.urlencode($username).'/'.urlencode($repository).'/forks', array_merge(array('page' => 1), $params), array( 'include_headers' => true ) );
    }

    public function create($username, $repository, array $params = array())
    {
        return $this->post('repos/'.urlencode($username).'/'.urlencode($repository).'/forks', $params);
    }
}
