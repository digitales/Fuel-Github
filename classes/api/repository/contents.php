<?php

namespace Github\Api\Repository;

use Github\Api\Abstract_Api;
use Github\Exception\MissingArgumentException;

/**
 * @link   http://developer.github.com/v3/repos/contents/
 * @author Ross Tweedie <ross.tweedie at gmail dot com>
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
class Contents extends Abstract_Api
{
    public function readme($username, $repository, $reference = null)
    {
        return $this->show($username, $repository, 'readme', $reference);
    }

    public function show($username, $repository, $path = null, $reference = null)
    {
        $url = 'repos/'.urlencode($username).'/'.urlencode($repository).'/contents';
        if (null !== $path) {
            $url .= '/'.urlencode($path);
        }

        return $this->get($url, array(
            'ref' => $reference
        ));
    }

    public function archive($username, $repository, $format, $reference = null)
    {
        if (!in_array($format, array('tarball', 'zipball'))) {
            $format = 'tarball';
        }

        return $this->get('repos/'.urlencode($username).'/'.urlencode($repository).'/'.urlencode($format), array(
            'ref' => $reference
        ));
    }
}
