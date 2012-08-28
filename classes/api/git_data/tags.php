<?php

namespace Github\Api\Git_Data;

use Github\Api\Abstract_Api;
use Github\Exception\MissingArgumentException;

/**
 * @link   http://developer.github.com/v3/git/tags/
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
class Tags extends Abstract_Api
{
    public function all($username, $repository)
    {
        return $this->get('repos/'.urlencode($username).'/'.urlencode($repository).'/git/refs/tags');
    }

    public function show($username, $repository, $sha)
    {
        return $this->get('repos/'.urlencode($username).'/'.urlencode($repository).'/git/tags/'.urlencode($sha));
    }

    public function create($username, $repository, array $params)
    {
        if (!isset($params['tag'], $params['message'], $params['object'], $params['type'])) {
            throw new MissingArgumentException(array('tag', 'message', 'object', 'type'));
        }

        if (!isset($params['tagger'])) {
            throw new MissingArgumentException('tagger');
        }

        if (!isset($params['tagger']['name'], $params['tagger']['email'], $params['tagger']['date'])) {
            throw new MissingArgumentException(array('tagger.name', 'tagger.email', 'tagger.date'));
        }

        return $this->post('repos/'.urlencode($username).'/'.urlencode($repository).'/git/tags', $params);
    }
}
