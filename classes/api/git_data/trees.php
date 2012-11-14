<?php

namespace Github\Api\Git_Data;

use Github\Api\Abstract_Api;
use Github\Exception\Exception_Argument_Missing;

/**
 * @link   http://developer.github.com/v3/git/trees/
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
class Trees extends Abstract_Api
{
    public function show($username, $repository, $sha, $recursive = false)
    {
        return $this->get('repos/'.urlencode($username).'/'.urlencode($repository).'/git/trees/'.urlencode($sha), array('recursive' => $recursive ? 1 : null));
    }

    public function create($username, $repository, array $params)
    {
        if (!isset($params['tree'])) {
            throw new Exception_Argument_Missing('tree');
        }
        if (!isset($params['tree']['path'], $params['tree']['mode'], $params['tree']['type'])) {
            throw new Exception_Argument_Missing(array('tree.path', 'tree.mode', 'tree.type'));
        }

        // If `sha` is not set, `content` is required
        if (!isset($params['tree']['sha']) && !isset($params['tree']['content'])) {
            throw new Exception_Argument_Missing('tree.content');
        }

        return $this->post('repos/'.urlencode($username).'/'.urlencode($repository).'/git/trees', $params);
    }
}
