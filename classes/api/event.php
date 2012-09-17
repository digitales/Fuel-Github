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
     * @param void
     *
     * @return array    list of public events.
     */
    public function all( )
    {
        return $this->get( 'events' );        
    }
    
    
    /**
    * List all the public events across the detailed repository
    * @link http://developer.github.com/v3/events/#list-repository-events
    *
    * @param  string  $user         the user
    * @param  string  $repository   the repository name
    *
    * @return array                  the events
    */
    public function repository( $user, $repository )
    {        
        return $this->get( 'repos/' . urlencode( $user ) . '/' . urlencode( $repository ) .'/events' );   
    }
    
    
    /**
    * List all repositories across all the organisations that you can access
    * @link http://developer.github.com/v3/events/#list-issue-events-for-a-repository
    *
    * @param  string  $user         the user
    * @param  string  $repository   the repository name
    *
    * @return array                  the events
    */
    public function repositoryIssues( $user, $repository )
    {        
        return $this->get( 'repos/' . urlencode( $user ) . '/' . urlencode( $repository ) .'/issues/events' );   
    }
    
    
    /**
    * List public events for a network of repositories
    * @link http://developer.github.com/v3/events/#list-issue-events-for-a-repository
    *
    * @param  string  $user         the user
    * @param  string  $repository   the repository name
    *
    * @return array                  the events
    */
    public function network( $user, $repository )
    {        
        return $this->get( 'networks/' . urlencode( $user ) . '/' . urlencode( $repository ) .'/events' );   
    }
    
    
    public function organisation( $oragnisation )
    {        
        return $this->get( 'orgs/' . urlencode( $oragnisation ) . '/events' );   
    }
    
    public function userReceived( $user )
    {        
        return $this->get( 'users/' . urlencode( $user) . '/received_events' );   
    }
    
    
    public function userReceivedPublic( $user )
    {        
        return $this->get( 'users/' . urlencode( $user) . '/received_events/public' );   
    }
    
    
    /**
     * List events performed by the user
     *
     * If the user is authenticated, the you will retrieve their private events.
     *
     * @param string user
     *
     * @return array
     */
    public function userEvents( $user )
    {        
        return $this->get( 'users/' . urlencode( $user) . '/events' );   
    }
    
    
    public function userEventsPublic( $user )
    {        
        return $this->get( 'users/' . urlencode( $user) . '/events/public' );   
    }
    
    /**
     * List events for an oganisation
     * This is the userÕs organization dashboard. You must be authenticated as the user to view this.
     *
     * @param string $user
     * @param string $organisation
     *
     * @return array
     */
    public function userOrganisation( $user, $organisation )
    {
        
        echo 'users/' . urlencode( $user ) . '/events/orgs/' . urlencode( $organisation );
        
        return $this->get( 'users/' . urlencode( $user ) . '/events/orgs/' . urlencode( $organisation ) );
    }

    
}