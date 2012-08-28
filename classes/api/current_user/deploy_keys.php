<?php

namespace Github\Api\Current_User;

use Github\Api\Abstract_Api;
use Github\Exception_Argument_Missing;

/**
 * @link   http://developer.github.com/v3/users/keys/
 * @author Ross Tweedie <ross.tweedie at gmail dot com>
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
class Deploy_Keys extends Abstract_Api
{
    /**
     * List deploy keys for the authenticated user
     * @link http://developer.github.com/v3/repos/keys/
     *
     * @return array
     */
    public function all()
    {
        return $this->get('user/keys');
    }

    /**
     * Shows deploy key for the authenticated user
     * @link http://developer.github.com/v3/repos/keys/
     *
     * @param  string $id
     * @return array
     */
    public function show($id)
    {
        return $this->get('user/keys/'.urlencode($id));
    }

    /**
     * Adds deploy key for the authenticated user
     * @link http://developer.github.com/v3/repos/keys/
     *
     * @param  array $params
     * @return array
     *
     * @throws MissingArgumentException
     */
    public function create(array $params)
    {
        if (!isset($params['title'], $params['key'])) {
            throw new MissingArgumentException(array('title', 'key'));
        }

        return $this->post('user/keys', $params);
    }

    /**
     * Updates deploy key for the authenticated user
     * @link http://developer.github.com/v3/repos/keys/
     *
     * @param  string $id
     * @param  array  $params
     * @return array
     *
     * @throws MissingArgumentException
     */
    public function update($id, array $params)
    {
        if (!isset($params['title'], $params['key'])) {
            throw new MissingArgumentException(array('title', 'key'));
        }

        return $this->patch('user/keys/'.urlencode($id), $params);
    }

    /**
     * Removes deploy key for the authenticated user
     * @link http://developer.github.com/v3/repos/keys/
     *
     * @param  string $id
     * @return array
     */
    public function remove($id)
    {
        return $this->delete('user/keys/'.urlencode($id));
    }
}