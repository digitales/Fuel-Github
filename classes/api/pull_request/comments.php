<?php

namespace Github\Api\Pull_Request;

use Github\Api\Abstract_Api;
use Github\Exception\Exception_Argument_Missing;

/**
 * @link   http://developer.github.com/v3/pulls/comments/
 * @author Ross Tweedie <ross.tweedie at gmail dot com>
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
class Comments extends Abstract_Api
{
    public function all($username, $repository, $pullRequest)
    {
        return $this->get('repos/'.urlencode($username).'/'.urlencode($repository).'/pulls/'.urlencode($pullRequest).'/comments');
    }

    public function show($username, $repository, $comment)
    {
        return $this->get('repos/'.urlencode($username).'/'.urlencode($repository).'/pulls/comments/'.urlencode($comment));
    }

    public function create($username, $repository, $pullRequest, array $params)
    {
        if (!isset($params['body'])) {
            throw new Exception_Argument_Missing('body');
        }

        // If `in_reply_to` is set, other options are not necessary anymore
        if (!isset($params['in_reply_to']) && !isset($params['commit_id'], $params['path'], $params['position'])) {
            throw new Exception_Argument_Missing(array('commit_id', 'path', 'position'));
        }

        return $this->post('repos/'.urlencode($username).'/'.urlencode($repository).'/pulls/'.urlencode($pullRequest).'/comments', $params);
    }

    public function update($username, $repository, $comment, array $params)
    {
        if (!isset($params['body'])) {
            throw new Exception_Argument_Missing('body');
        }

        return $this->patch('repos/'.urlencode($username).'/'.urlencode($repository).'/pulls/comments/'.urlencode($comment), $params);
    }

    public function remove($username, $repository, $comment)
    {
        return $this->delete('repos/'.urlencode($username).'/'.urlencode($repository).'/pulls/comments/'.urlencode($comment));
    }
}
