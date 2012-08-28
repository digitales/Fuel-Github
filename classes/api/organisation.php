<?php

namespace Github\Api;

use Github\Api\Abstract_Api;
use Github\Api\Organisation\Members;
use Github\Api\Organisation\Teams;

/**
 * Getting organisation information and managing authenticated organisation information.
 *
 * @link   http://developer.github.com/v3/orgs/
 * @author Ross Tweedie <ross.tweedie at gmail dot com>
 * @author Antoine Berranger <antoine at ihqs dot net>
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
class Organisation extends Abstract_Api
{
    /**
     * Get extended information about an organisation by its name
     * @link http://developer.github.com/v3/orgs/#get
     *
     * @param  string  $organisation     the organisation to show
     *
     * @return array                     information about the organisation
     */
    public function show($organisation)
    {
        return $this->get('orgs/'.urlencode($organisation));
    }

    public function update($organisation, array $params)
    {
        return $this->patch('orgs/'.urlencode($organisation), $params);
    }

    /**
     * List all repositories across all the organisations that you can access
     * @link http://developer.github.com/v3/repos/#list-organization-repositories
     *
     * @param  string  $organisation     the organisation name
     * @param  string  $type             the type of repositories
     *
     * @return array                     the repositories
     */
    public function repositories($organisation, $type = 'all')
    {
        return $this->get('orgs/'.urlencode($organisation).'/repos', array(
            'type' => $type
        ));
    }

    /**
     * @return Members
     */
    public function members()
    {
        return new Members($this->client);
    }

    /**
     * @return Teams
     */
    public function teams()
    {
        return new Teams($this->client);
    }
}
