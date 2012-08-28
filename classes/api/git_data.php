<?php

namespace Github\Api;

use Github\Api\Abstract_Api;
use Github\Api\Git_Data\Blobs;
use Github\Api\Git_Data\Commits;
use Github\Api\Git_Data\References;
use Github\Api\Git_Data\Tags;
use Github\Api\Git_Data\Trees;

/**
 * Getting full versions of specific files and trees in your Git repositories.
 *
 * @link   http://developer.github.com/v3/git/
 * @author Ross Tweedie <ross.tweedie at gmail dot com>
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
class Git_Data extends Abstract_Api
{
    /**
     * @return Blobs
     */
    public function blobs()
    {
        return new Blobs($this->client);
    }

    /**
     * @return Commits
     */
    public function commits()
    {
        return new Commits($this->client);
    }

    /**
     * @return References
     */
    public function references()
    {
        return new References($this->client);
    }

    /**
     * @return Tags
     */
    public function tags()
    {
        return new Tags($this->client);
    }

    /**
     * @return Trees
     */
    public function trees()
    {
        return new Trees($this->client);
    }
}
