<?php

class Client extends Entity
{
    public function create(array $data): false|int
    {
        $patronymic = trim($data['patronymic']);
        $res = $this->db->exec('
            INSERT INTO `client` 
                (`name`, `surname`, `patronymic`, `phone`)
                VALUES (:name, :surname, :patronymic, :phone);
        ', [
            ':name' => $data['name'], 
            ':surname' => $data['surname'], 
            ':patronymic' => $patronymic === '' ? null : $patronymic, 
            ':phone' => $data['phone']
        ]);
        if ($res) {
            return $this->db->lastInsertId;
        }
        return $res;
    }
    public function getByPhone(string $phone): false|array
    {
        return $this->db->findOne('SELECT * FROM `client` WHERE `phone`=:phone', [':phone' => $phone]);
    }
}