<?php

use App\Model;

class User extends Model
{
    public function __construct()
    {
        $this->table = "users";

        $this->getConnection();
    }
}
