<?php

namespace Github\Api\Git_Data;

use Github\Api\Abstract_Api;
use Github\Exception\Exception_Argument_Missing;

/**
 * @link   http://developer.github.com/v3/git/commits/
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
class Commits extends Abstract_Api
{
    public function show($username, $repository, $sha)
    {
        return $this->get('repos/'.urlencode($username).'/'.urlencode($repository).'/commits/'.urlencode($sha));
    }

    public function create($username, $repository, array $params)
    {
        if (!isset($params['message'], $params['tree'], $params['parents'])) {
            throw new Exception_Argument_Missing(array('message', 'tree', 'parents'));
        }

        return $this->post('repos/'.urlencode($username).'/'.urlencode($repository).'/git/commits', $params);
    }
}
