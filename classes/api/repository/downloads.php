<?php

namespace Github\Api\Repository;

use Github\Api\Abstract_Api;

/**
 * @link   http://developer.github.com/v3/repos/downloads/
 * @author Ross Tweedie <ross.tweedie at gmail dot com>
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
class Downloads extends Abstract_Api
{
    /**
     * List downloads in selected repository
     * @link http://developer.github.com/v3/repos/downloads/
     *
     * @param  string  $username         the user who owns the repo
     * @param  string  $repository       the name of the repo
     * @param  array   $params          the params to pass through, for example the page number
     * @return array
     */
    public function all($username, $repository, $params = array() )
    {
        // The all method supports pagination, so let's also retrieve the response headers
        return $this->get('repos/'.urlencode($username).'/'.urlencode($repository).'/downloads', $params, array( 'include_headers' => true ) );
    }

    /**
     * Get a download in selected repository
     * @link http://developer.github.com/v3/repos/downloads/
     *
     * @param  string  $username         the user who owns the repo
     * @param  string  $repository       the name of the repo
     * @param  integer $id               the id of the download file
     *
     * @return array
     */
    public function show($username, $repository, $id)
    {
        return $this->get('repos/'.urlencode($username).'/'.urlencode($repository).'/downloads/'.urlencode($id));
    }

    /**
     * Delete a download in selected repository
     * @link http://developer.github.com/v3/repos/downloads/#delete-a-download
     *
     * @param  string  $username         the user who owns the repo
     * @param  string  $repository       the name of the repo
     * @param  integer $id               the id of the download file
     *
     * @return array
     */
    public function remove($username, $repository, $id)
    {
        return $this->delete('repos/'.urlencode($username).'/'.urlencode($repository).'/downloads/'.urlencode($id));
    }
}
