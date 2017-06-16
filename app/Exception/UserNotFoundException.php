<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 6/16/17
 * Time: 3:12 AM
 */

namespace QKidsDemo\Exception;

class UserNotFoundException extends SessionStorageException
{
    public function __construct($id)
    {
        parent::__construct(sprintf('User with id "%d" was not found in storage', $id));
    }
}
