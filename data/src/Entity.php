<?php

abstract class Entity
{
    protected DataBase $db;

    public function __construct(DataBase $db)
    {
        $this->db = $db;
    }
}
