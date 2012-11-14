<?php
namespace Github\Exception;

/**
 * ApiLimitExceedException
 *
 */
class Exception_Api_Limit extends \Exception
{
    public function __construct($limit)
    {
        parent::__construct('You have reached GitHub hour limit! Actual limit is: '. $limit);
    }
}
