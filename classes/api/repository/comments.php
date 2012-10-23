<?php

namespace Github\Api\Repository;

use Github\Api\Abstract_Api;
use Github\Exception\MissingArgumentException;

/**
 * @link   http://developer.github.com/v3/repos/comments/
 * @author Ross Tweedie <ross.tweedie at gmail dot com>
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
class Comments extends Abstract_Api
{
    public function all($username, $repository, $sha = null, $params = array() )
    {
        // The all method supports pagination, so let's also retrieve the response headers

        if (null === $sha) {
            return $this->get('repos/'.urlencode($username).'/'.urlencode($repository).'/comments', $params, array( 'include_headers' => true ));
        }

        return $this->get('repos/'.urlencode($username).'/'.urlencode($repository).'/commits/'.urlencode($sha).'/comments', array(), array( 'include_headers' => true ) );
    }

    public function show($username, $repository, $comment)
    {
        return $this->get('repos/'.urlencode($username).'/'.urlencode($repository).'/comments/'.urlencode($comment));
    }

    public function create($username, $repository, $sha, array $params)
    {
        if (!isset($params['body'], $params['commit_id'], $params['line'], $params['path'], $params['position'])) {
            throw new MissingArgumentException(array('body', 'commit_id', 'line', 'path', 'position'));
        }

        return $this->post('repos/'.urlencode($username).'/'.urlencode($repository).'/commits/'.urlencode($sha).'/comments', $params);
    }

    public function update($username, $repository, $comment, array $params)
    {
        if (!isset($params['body'])) {
            throw new MissingArgumentException('body');
        }

        return $this->patch('repos/'.urlencode($username).'/'.urlencode($repository).'/comments/'.urlencode($comment), $params);
    }

    public function remove($username, $repository, $comment)
    {
        return $this->delete('repos/'.urlencode($username).'/'.urlencode($repository).'/comments/'.urlencode($comment));
    }
}
