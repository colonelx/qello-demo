<?php

namespace QKidsDemo\Exception;

class UserNotFoundException extends SessionStorageException
{
    public function __construct($id)
    {
        parent::__construct(sprintf('User with id "%d" was not found in storage', $id));
    }
}
