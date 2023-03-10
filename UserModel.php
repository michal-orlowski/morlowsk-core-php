<?php

namespace morlowsk\corephp;
use morlowsk\corephp\db\DbModel;

/**
 * Summary of UserModel
 * @author Michal Orlowski
 * @copyright (c) 2023
 */
abstract class UserModel extends DbModel
{
    abstract public function getDisplayName(): string;
    
}