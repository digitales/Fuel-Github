<?php

namespace Github\Api\Issue;

use Github\Api\Abstract_Api;
use Github\Exception_Argument_Invalid;

/**
 * @link   http://developer.github.com/v3/issues/labels/
 * @author Ross Tweedie <ross.tweedie at gmail dot com>
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
class Labels extends Abstract_Api
{
    public function all($username, $repository, $issue, $page = 1)
    {
        return $this->get('repos/'.urlencode($username).'/'.urlencode($repository).'/issues/'.urlencode($issue).'/labels', array( 'page' => $page ), array( 'include_headers' => true ) );
    }

    public function add($username, $repository, $issue, $labels)
    {
        if (is_string($labels)) {
            $labels = array($labels);
        } elseif (0 === count($labels)) {
            throw new Exception_Argument_Invalid();
        }

        return $this->post('repos/'.urlencode($username).'/'.urlencode($repository).'/issues/'.urlencode($issue).'/labels', $labels);
    }

    public function replace($username, $repository, $issue, array $params)
    {
        return $this->put('repos/'.urlencode($username).'/'.urlencode($repository).'/issues/'.urlencode($issue).'/labels', $params);
    }

    public function remove($username, $repository, $issue, $label)
    {
        return $this->delete('repos/'.urlencode($username).'/'.urlencode($repository).'/issues/'.urlencode($issue).'/labels/'.urlencode($label));
    }

    public function clear($username, $repository, $issue)
    {
        return $this->delete('repos/'.urlencode($username).'/'.urlencode($repository).'/issues/'.urlencode($issue).'/labels');
    }
}
