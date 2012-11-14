<?php

namespace Github\Api\Organisation;

use Github\Api\Abstract_Api;
use Github\Exception\Exception_Argument_Missing;

/**
 * @link   http://developer.github.com/v3/orgs/teams/
 * @author Ross Tweedie <ross.tweedie at gmail dot com>
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
class Teams extends Abstract_Api
{
    public function all($organisation, $params = array() )
    {
        return $this->get('orgs/'.urlencode($organisation).'/teams', $params, array( 'include_headers' => true ));
    }

    public function show($organisation, $team)
    {
        return $this->get('orgs/'.urlencode($organisation).'/teams/'.urlencode($team));
    }

    public function create($organisation, array $params)
    {
        if (!isset($params['name'])) {
            throw new Exception_Argument_Missing('name');
        }
        if (isset($params['repo_names']) && !is_array($params['repo_names'])) {
            $params['repo_names'] = array($params['repo_names']);
        }
        if (isset($params['permission']) && !in_array($params['permission'], array('pull', 'push', 'admin'))) {
            $params['permission'] = 'pull';
        }

        return $this->post('orgs/'.urlencode($organisation).'/teams', $params);
    }

    public function update($team, array $params)
    {
        if (!isset($params['name'])) {
            throw new Exception_Argument_Missing('name');
        }
        if (isset($params['permission']) && !in_array($params['permission'], array('pull', 'push', 'admin'))) {
            $params['permission'] = 'pull';
        }

        return $this->patch('teams/'.urlencode($team), $params);
    }

    public function remove($team)
    {
        return $this->delete('teams/'.urlencode($team));
    }

    public function members($team)
    {
        return $this->get('teams/'.urlencode($team).'/members');
    }

    public function check($team, $username)
    {
        return $this->get('teams/'.urlencode($team).'/members/'.urlencode($username));
    }

    public function addMember($team, $username)
    {
        return $this->put('teams/'.urlencode($team).'/members/'.urlencode($username));
    }

    public function removeMember($team, $username)
    {
        return $this->delete('teams/'.urlencode($team).'/members/'.urlencode($username));
    }

    public function repositories($team)
    {
        return $this->get('teams/'.urlencode($team).'/repos');
    }

    public function repository($team, $username, $repository)
    {
        return $this->get('teams/'.urlencode($team).'/repos/'.urlencode($username).'/'.urlencode($repository));
    }

    public function addRepository($team, $username, $repository)
    {
        return $this->put('teams/'.urlencode($team).'/repos/'.urlencode($username).'/'.urlencode($repository));
    }

    public function removeRepository($team, $username, $repository)
    {
        return $this->delete('teams/'.urlencode($team).'/repos/'.urlencode($username).'/'.urlencode($repository));
    }
}
