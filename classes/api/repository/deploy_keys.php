<?php

namespace Github\Api\Repository;

use Github\Api\Abstract_Api;
use Github\Exception\Exception_Argument_Missing;

/**
 * @link   http://developer.github.com/v3/repos/keys/
 * @author Ross Tweedie <ross.tweedie at gmail dot com>
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
class Deploy_Keys extends Abstract_Api
{
    public function all($username, $repository, $params = array() )
    {
        // The all method supports pagination, so let's also retrieve the response headers
        return $this->get('repos/'.urlencode($username).'/'.urlencode($repository).'/keys', $params, array( 'include_headers' => true ) );
    }

    public function show($username, $repository, $id)
    {
        return $this->get('repos/'.urlencode($username).'/'.urlencode($repository).'/keys/'.urlencode($id));
    }

    public function create($username, $repository, array $params)
    {
        if (!isset($params['title'], $params['key'])) {
            throw new Exception_Argument_Missing(array('title', 'key'));
        }

        return $this->post('repos/'.urlencode($username).'/'.urlencode($repository).'/keys', $params);
    }

    public function update($username, $repository, $id, array $params)
    {
        if (!isset($params['title'], $params['key'])) {
            throw new Exception_Argument_Missing(array('title', 'key'));
        }

        return $this->patch('repos/'.urlencode($username).'/'.urlencode($repository).'/keys/'.urlencode($id), $params);
    }

    public function remove($username, $repository, $id)
    {
        return $this->delete('repos/'.urlencode($username).'/'.urlencode($repository).'/keys/'.urlencode($id));
    }
}
