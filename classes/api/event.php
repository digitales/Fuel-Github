<?php

namespace Github\Api;

use Github\Api\Abstract_Api;


/**
 * Getting events.
 *
 * @link   http://developer.github.com/v3/events/
 * @author Ross Tweedie <ross.tweedie at gmail dot com>
 */
class Event extends Abstract_Api
{

    /**
     * Get list of public events
     * @link http://developer.github.com/v3/events/#list-public-events
     *
     * @param integer $page
     *
     * @return array    list of public events.
     */
    public function all( $page = 1 )
    {
        // The all method supports pagination, so let's also retrieve the response headers
        return $this->get( 'events', array( 'page' => $page ), array( 'include_headers' => true ) );
    }


    /**
    * List all the public events across the detailed repository
    * @link http://developer.github.com/v3/events/#list-repository-events
    *
    * @param  string  $user         the user
    * @param  string  $repository   the repository name
    * @param integer $page          the page of results to return
    *
    * @return array                 the events
    */
    public function repository( $user, $repository, $page = 1 )
    {
        // The repository method supports pagination, so let's also retrieve the response headers
        return $this->get( 'repos/' . urlencode( $user ) . '/' . urlencode( $repository ) .'/events', array( 'page' => $page ), array( 'include_headers' => true ) );
    }


    /**
    * List all repositories across all the organisations that you can access
    * @link http://developer.github.com/v3/events/#list-issue-events-for-a-repository
    *
    * @param  string  $user         the user
    * @param  string  $repository   the repository name
    * @param integer  $page         the page of results to return
    *
    * @return array                  the events
    */
    public function repositoryIssues( $user, $repository, $page = 1 )
    {
        return $this->get( 'repos/' . urlencode( $user ) . '/' . urlencode( $repository ) .'/issues/events', array( 'page' => $page ), array( 'include_headers' => true ) );
    }


    /**
    * List public events for a network of repositories
    * @link http://developer.github.com/v3/events/#list-issue-events-for-a-repository
    *
    * @param  string  $user         the user
    * @param  string  $repository   the repository name
    * @param integer $page          the page of results to return
    *
    * @return array                  the events
    */
    public function network( $user, $repository )
    {
        return $this->get( 'networks/' . urlencode( $user ) . '/' . urlencode( $repository ) .'/events', array( 'page' => $page ), array( 'include_headers' => true ) );
    }


    public function organisation( $organisation, $page = 1 )
    {
        return $this->get( 'orgs/' . urlencode( $organisation ) . '/events', array( 'page' => $page ), array( 'include_headers' => true ) );
    }

    public function userReceived( $user, $page = 1 )
    {
        return $this->get( 'users/' . urlencode( $user) . '/received_events', array( 'page' => $page ), array( 'include_headers' => true ) );
    }


    public function userReceivedPublic( $user, $page = 1 )
    {
        return $this->get( 'users/' . urlencode( $user) . '/received_events/public', array( 'page' => $page ), array( 'include_headers' => true ) );
    }


    /**
     * List events performed by the user
     *
     * If the user is authenticated, the you will retrieve their private events.
     *
     * @param string user       the user to get events for
     * @param integer $page     the page of results to return
     *
     * @return array
     */
    public function userEvents( $user, $page = 1 )
    {
        return $this->get( 'users/' . urlencode( $user) . '/events', array( 'page' => $page ), array( 'include_headers' => true ) );
    }


    public function userEventsPublic( $user, $page = 1  )
    {
        return $this->get( 'users/' . urlencode( $user) . '/events/public', array( 'page' => $page ), array( 'include_headers' => true ) );
    }

    /**
     * List events for an oganisation
     * This is the userÕs organization dashboard. You must be authenticated as the user to view this.
     *
     * @param string $user
     * @param string $organisation
     * @param integer $page         the page of results to return
     *
     * @return array
     */
    public function userOrganisation( $user, $organisation )
    {
        return $this->get( 'users/' . urlencode( $user ) . '/events/orgs/' . urlencode( $organisation ), array( 'page' => $page ), array( 'include_headers' => true ) );
    }


}
