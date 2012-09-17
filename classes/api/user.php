<?php
namespace Github\Api;

use Github\Api\Abstract_Api;

/**
 * Searching users, getting user information
 *
 * @link   http://developer.github.com/v3/users/
 * @author Ross Tweedie <ross.tweedie at gmail dot com>
 * @author Joseph Bielawski <stloyd@gmail.com>
 * @author Thibault Duplessis <thibault.duplessis at gmail dot com>
 */
class User extends Abstract_Api
{
    
    /**
     * Search users by username:
     * @link http://developer.github.com/v3/search/#search-users
     *
     * @param  string $keyword the keyword to search
     *
     * @return array           list of users found
     */
    public function find( $keyword )
    {
        return $this->get( 'legacy/user/search/' . urlencode( $keyword ) );
    }

    
    /**
     * Get extended information about a user by its username
     * @link http://developer.github.com/v3/users/
     *
     * @param  null || string  $username the username to show
     * @return array informations about the user
     */
    public function show( $username = null )
    {
        $url = 'user';
        
        if ( $username ){
            $url = 'users/' . urlencode( $username );
        }
        
        return $this->get( $url );
    }

    
    /**
     * Request the users that a specific user is following
     * @link http://developer.github.com/v3/users/followers/
     *
     * @param  null || string  $username
     * @return array list of followed users
     */
    public function following( $username = null )
    {
        $url =  'user/following' ;
        
        if ( $username ){
            $url = $this->get('users/' . urlencode( $username ) . '/following');    
        }
        
        return $this->get( $url );
    }
    

    /**
     * Request the users following a specific user or the currently authenticated user.
     * @link http://developer.github.com/v3/users/followers/
     *
     * @param  string $username
     * @return array list of following users
     */
    public function followers( $username = null )
    {
        $url = 'user/followers';
        
        if( $username ){
            $url = 'users/' . urlencode( $username ) . '/followers';
        }
        
        return $this->get( $url );
    }

    
    /**
     * Request the repository that a specific user is watching (or the authenticated user)
     * @link http://developer.github.com/v3/repos/watching/
     *
     * @param  null || string  $username
     * @return array list of watched repositories
     */
    public function watched( $username = null )
    {
        return $this->get('users/' . urlencode( $username ) . '/watched');
    }

    
    /**
     * Get the repositories for a user or the authenticated user
     * @link http://developer.github.com/v3/repos/
     *
     * @param null || string $username
     * @return array list of the user repositories
     */
    public function repositories( $username = null )
    {
        $url = 'user/repos';
        
        if ( $username ){
            $url = 'users/' . urlencode( $username ) . '/repos';
        }
        
        return $this->get( $url );
    }
    
    
    /**
     * Get the oraganisations that the user is a member of
     * @link http://developer.github.com/v3/otgs/
     *
     * @param null || string $username
     * @return array list of the user repositories
     */
    public function organisations( $username = null )
    {
        $url = 'user/orgs';
        
        if ( $username ){
            $url = 'users/' . urlencode( $username ) . '/orgs';
        }
        
        return $this->get( $url );
    }
    
    
    /**
     * Alternative organisation spelling
     */
    public function organizations( $username ){
        return $this->organisations( $username );
    }

    
    /**
     * Get the public gists for a user
     * @link http://developer.github.com/v3/gists/
     *
     * @param  null || string  $username
     * @return array list of the user gists
     */
    public function gists( $username = null )
    {
        $url = 'user/gists';
        
        if ( $username ){
            $url = 'users/' . urlencode( $username ) . '/gists';
        }
        
        return $this->get( $url );
    }
    
}