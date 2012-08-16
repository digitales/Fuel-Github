<?php

namespace Github;

/**
 * MissingArgumentException
 *
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
class Exception_Argument_Missing extends \Exception
{
    /**
     * @param string|array $required
     */
    public function __construct($required)
    {
        if (is_string($required)) {
            $required = array($required);
        }

        parent::__construct(sprintf('One or more of required ("%s") parameters is missing!', implode('", "', $required)));
    }
}
