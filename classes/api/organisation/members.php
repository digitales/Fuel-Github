<?php

namespace Github\Api\Organisation;

use Github\Api\Abstract_Api;

/**
 * @link   http://developer.github.com/v3/orgs/members/
 * @author Ross Tweedie <ross.tweedie at gmail dot com>
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
class Members extends Abstract_Api
{
    public function all($organisation, $type = null, $params = array() )
    {
        if (null === $type) {
            return $this->get('orgs/'.urlencode($organisation).'/members');
        }

        return $this->get('orgs/'.urlencode($organisation).'/public_members', $params, array( 'include_headers' => true ));
    }

    public function show($organisation, $username)
    {
        return $this->get('orgs/'.urlencode($organisation).'/members/'.urlencode($username));
    }

    public function check($organisation, $username)
    {
        return $this->get('orgs/'.urlencode($organisation).'/public_members/'.urlencode($username));
    }

    public function publicize($organisation, $username)
    {
        return $this->put('orgs/'.urlencode($organisation).'/public_members/'.urlencode($username));
    }

    public function conceal($organisation, $username)
    {
        return $this->delete('orgs/'.urlencode($organisation).'/public_members/'.urlencode($username));
    }

    public function remove($organisation, $username)
    {
        return $this->delete('orgs/'.urlencode($organisation).'/members/'.urlencode($username));
    }
}
