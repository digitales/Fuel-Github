<?php

namespace Github\Api;

use Github\Api\Abstract_Api;

use Github\Exception\Exception_Argument_Missing;

/**
 * Creating, editing, deleting and listing gists
 *
 * @link   http://developer.github.com/v3/gists/
 * @author Ross Tweedie <ross.tweedie at gmail dot com>
 * @author Joseph Bielawski <stloyd@gmail.com>
 * @author Edoardo Rivello <edoardo.rivello at gmail dot com>
 */
class Gists extends Abstract_Api
{
    public function all($type = null)
    {
        if (!in_array($type, array('public', 'starred'))) {
            return $this->get('gists');
        }

        return $this->get('gists/'.urlencode($type));
    }

    public function show($number)
    {
        return $this->get('gists/'.urlencode($number));
    }

    public function create(array $params)
    {
        if (!isset($params['files']) || (!is_array($params['files']) || 0 === count($params['files']))) {
            throw new Exception_Argument_Missing('files');
        }

        $params['public'] = (boolean) $params['public'];

        return $this->post('gists', $params);
    }

    public function update($id, array $params)
    {
        return $this->patch('gists/'.urlencode($id), $params);
    }

    public function fork($id)
    {
        return $this->post('gists/'.urlencode($id).'/fork');
    }

    public function remove($id)
    {
        return $this->delete('gists/'.urlencode($id));
    }

    public function check($id)
    {
        return $this->get('gists/'.urlencode($id).'/star');
    }

    public function star($id)
    {
        return $this->put('gists/'.urlencode($id).'/star');
    }

    public function unstar($id)
    {
        return $this->delete('gists/'.urlencode($id).'/star');
    }
}
