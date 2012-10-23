<?php

namespace Github\Api\Issue;

use Github\Api\Abstract_Api;

/**
 * @link   http://developer.github.com/v3/issues/events/
 * @author Ross Tweedie <ross.tweedie at gmail dot com>
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
class Events extends Abstract_Api
{
    public function all($username, $repository, $issue = null, $page = 1)
    {
        if (null !== $issue) {
            return $this->get('repos/'.urlencode($username).'/'.urlencode($repository).'/issues/'.urlencode($issue).'/events', array(
                'page' => $page
            ), array( 'include_headers' => true ) );
        }

        return $this->get('repos/'.urlencode($username).'/'.urlencode($repository).'/issues/events', array(
            'page' => $page
        ));
    }

    public function show($username, $repository, $event)
    {
        return $this->get('repos/'.urlencode($username).'/'.urlencode($repository).'/issues/events/'.urlencode($event));
    }
}
