<?php

namespace Github\Api\Current_User;

use Github\Api\Abstract_Api;
use Github\Exception_Argument_Invalid;

/**
 * @link   http://developer.github.com/v3/users/emails/
 * @author Ross Tweedie <ross.tweedie at gmail dot com>
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
class Emails extends Abstract_Api
{
    /**
     * List emails for the authenticated user
     * @link http://developer.github.com/v3/users/emails/
     *
     * @return array
     */
    public function all()
    {
        return $this->get('user/emails');
    }

    /**
     * Adds one or more email for the authenticated user
     * @link http://developer.github.com/v3/users/emails/
     *
     * @param  string|array $emails
     * @return array
     *
     * @throws Exception_Argument_Invalid
     */
    public function add($emails)
    {
        if (is_string($emails)) {
            $emails = array($emails);
        } elseif (0 === count($emails)) {
            throw new Exception_Argument_Invalid();
        }

        return $this->post('user/emails', $emails);
    }

    /**
     * Removes one or more email for the authenticated user
     * @link http://developer.github.com/v3/users/emails/
     *
     * @param  string|array $emails
     * @return array
     *
     * @throws Exception_Argument_Invalid
     */
    public function remove($emails)
    {
        if (is_string($emails)) {
            $emails = array($emails);
        } elseif (0 === count($emails)) {
            throw new Exception_Argument_Invalid();
        }

        return $this->delete('user/emails', $emails);
    }
}
