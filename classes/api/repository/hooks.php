<?php

namespace Github\Api\Repository;

use Github\Api\Abstract_Api;
use Github\Exception\Exception_Argument_Missing;

/**
 * @link   http://developer.github.com/v3/issues/hooks/
 * @author Ross Tweedie <ross.tweedie at gmail dot com>
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
class Hooks extends Abstract_Api
{
    public function all($username, $repository, $params = array() )
    {
        // The all method supports pagination, so let's also retrieve the response headers
        return $this->get('repos/'.urlencode($username).'/'.urlencode($repository).'/hooks', $params, array( 'include_headers' => true ) );
    }

    public function show($username, $repository, $id)
    {
        return $this->get('repos/'.urlencode($username).'/'.urlencode($repository).'/hooks/'.urlencode($id));
    }

    public function create($username, $repository, array $params)
    {
        if (!isset($params['name'], $params['config'])) {
            throw new Exception_Argument_Missing(array('name', 'config'));
        }

        return $this->post('repos/'.urlencode($username).'/'.urlencode($repository).'/hooks', $params);
    }

    public function update($username, $repository, $id, array $params)
    {
        if (!isset($params['name'], $params['config'])) {
            throw new Exception_Argument_Missing(array('name', 'config'));
        }

        return $this->patch('repos/'.urlencode($username).'/'.urlencode($repository).'/hooks/'.urlencode($id), $params);
    }

    public function test($username, $repository, $id)
    {
        return $this->post('repos/'.urlencode($username).'/'.urlencode($repository).'/hooks/'.urlencode($id).'/test');
    }

    public function remove($username, $repository, $id)
    {
        return $this->delete('repos/'.urlencode($username).'/'.urlencode($repository).'/hooks/'.urlencode($id));
    }
}
